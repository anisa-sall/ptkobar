<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private function hasAccess($menuName, $menuAccess)
    {
        $departemen = Auth::user()->departemen ?? '';
        return isset($menuAccess[$menuName]) && in_array($departemen, $menuAccess[$menuName]);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Inisialisasi variabel dengan data user atau default
        $namapetugas = "Petugas";
        $email = "email@example.com";
        $departemen = "Marketing";

        if ($user) {
            $namapetugas = $user->name ?? "Petugas";
            $email = $user->email ?? "email@example.com";
            $departemen = $user->departemen ?? "Marketing";
            
            // Simpan di session
            Session::put('namapetugas', $namapetugas);
            Session::put('email', $email);
            Session::put('departemen', $departemen);
            Session::put('idpetugas', $user->id);
        }

        // Ambil hanya kata pertama dari nama
        $namadepan = explode(' ', $namapetugas)[0];
        
        $currentYearMonth = Carbon::now()->format('Y-m');

        // ===== 1. Hitung Invoice/Bulan ini =====
        $invoice_count = DB::table('invoice')
            ->whereRaw("DATE_FORMAT(tgl, '%Y-%m') = ?", [$currentYearMonth])
            ->count();

        // ===== 2. Status Summary Chart - Invoice per hari dalam bulan ini =====
        $statusSummaryData = DB::table('invoice')
            ->select(
                DB::raw("DAYNAME(tgl) as hari"),
                DB::raw("COUNT(*) as jumlah"),
                DB::raw("DAYOFWEEK(tgl) as day_order")
            )
            ->whereRaw("DATE_FORMAT(tgl, '%Y-%m') = ?", [$currentYearMonth])
            ->groupBy('hari', 'day_order')
            ->orderBy('day_order')
            ->limit(6)
            ->get();

        $status_labels = [];
        $status_data = [];

        if ($statusSummaryData->isNotEmpty()) {
            foreach ($statusSummaryData as $row) {
                $hari_full = $row->hari;
                $hari_singkat = strtoupper(substr($hari_full, 0, 3));
                $status_labels[] = $hari_singkat;
                $status_data[] = (int)$row->jumlah;
            }
        } else {
            $status_labels = ["SUN", "MON", "TUE", "WED", "THU", "FRI"];
            $status_data = [0, 0, 0, 0, 0, 0];
        }

        // Pastikan ada 6 data
        if (count($status_labels) < 6) {
            $default_labels = ["SUN", "MON", "TUE", "WED", "THU", "FRI"];
            while (count($status_labels) < 6) {
                $status_labels[] = $default_labels[count($status_labels)];
                $status_data[] = 0;
            }
        }

        // ===== 3. Status Purchase Order =====
        $po_status_labels = ['OPEN', 'PARTIAL', 'CLOSED'];
        $po_status_data = [0, 0, 0];
        $po_status_colors_array = ['#1F3BB3', '#FDD0C7', '#52CDFF'];
        
        try {
            // Query untuk OPEN PO - PO yang belum ada Surat Jalan sama sekali
            $open_po = DB::table('po')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('suratjalan')
                        ->whereColumn('suratjalan.nopo', 'po.nopo');
                })
                ->count();
            
            // Query untuk PARTIAL PO - PO yang sudah ada Surat Jalan tapi belum semua item terkirim
            $partial_po = DB::table('po')
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('suratjalan')
                        ->whereColumn('suratjalan.nopo', 'po.nopo');
                })
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('detailpo')
                        ->whereColumn('detailpo.nopo', 'po.nopo')
                        ->whereExists(function ($subquery) {
                            $subquery->select(DB::raw(1))
                                ->from('detailsuratjalan')
                                ->whereColumn('detailsuratjalan.nopart', 'detailpo.nopart')
                                ->whereRaw('detailsuratjalan.quantity < detailpo.quantity');
                        });
                })
                ->count();
            
            // Query untuk CLOSED PO - PO yang semua item sudah terkirim lengkap
            $closed_po = DB::table('po')
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('suratjalan')
                        ->whereColumn('suratjalan.nopo', 'po.nopo');
                })
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('detailpo')
                        ->whereColumn('detailpo.nopo', 'po.nopo')
                        ->whereExists(function ($subquery) {
                            $subquery->select(DB::raw(1))
                                ->from('detailsuratjalan')
                                ->whereColumn('detailsuratjalan.nopart', 'detailpo.nopart')
                                ->whereRaw('detailsuratjalan.quantity < detailpo.quantity');
                        });
                })
                ->count();
            
            $po_status_data = [$open_po, $partial_po, $closed_po];
        } catch (\Exception $e) {
            // Fallback jika query error
            $po_status_data = [0, 0, 0];
        }

        // ===== 4. Daftar Part untuk dropdown - PERBAIKAN DI SINI =====
        // Ambil part yang pernah ada transaksi (dari PO) atau semua part
        $parts = DB::table('part')
            ->select('nopart', 'namapart')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('detailpo')
                    ->whereColumn('detailpo.nopart', 'part.nopart');
            })
            ->orWhereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('detailsuratjalan')
                    ->whereColumn('detailsuratjalan.nopart', 'part.nopart');
            })
            ->distinct()
            ->orderBy('namapart')
            ->limit(15) // Tambah limit lebih banyak
            ->get()
            ->toArray();

        // Jika tidak ada part dengan transaksi, ambil beberapa part saja
        if (empty($parts)) {
            $parts = DB::table('part')
                ->select('nopart', 'namapart')
                ->orderBy('namapart')
                ->limit(10)
                ->get()
                ->toArray();
        }

        // ===== 5. Get selected part dari request =====
        $selected_part_id = $request->get('selected_part');
        $chart_labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        
        // Default: ambil part pertama jika ada
        if (empty($selected_part_id) && !empty($parts)) {
            $selected_part_id = $parts[0]->nopart;
        }

        $selected_part_name = "Pilih Part";
        $current_year_data = array_fill(0, 12, 0); // Index 0-11 untuk bulan 1-12
        $last_year_data = array_fill(0, 12, 0);
        $total_current_year = 0;
        $total_last_year = 0;
        $has_comparison_data = false;
        $current_year = date('Y');
        $last_year = $current_year - 1;

        if (!empty($selected_part_id) && !empty($parts)) {
            // Cari nama part yang dipilih
            foreach ($parts as $part) {
                if ($part->nopart == $selected_part_id) {
                    $selected_part_name = $part->namapart;
                    break;
                }
            }

            // ===== DATA TAHUN INI (NOMINAL) =====
            $currentYearQuery = DB::table('po')
                ->join('detailpo', 'po.nopo', '=', 'detailpo.nopo')
                ->select(
                    DB::raw('MONTH(po.tglpo) as bulan'),
                    DB::raw('COALESCE(SUM(detailpo.total), 0) as total_nominal')
                )
                ->where('detailpo.nopart', $selected_part_id)
                ->whereYear('po.tglpo', $current_year)
                ->groupBy(DB::raw('MONTH(po.tglpo)'))
                ->orderBy('bulan')
                ->get();

            foreach ($currentYearQuery as $row) {
                $bulan = (int)$row->bulan - 1; // Adjust untuk array index
                $current_year_data[$bulan] = (float)$row->total_nominal;
                $total_current_year += (float)$row->total_nominal;
            }

            // ===== DATA TAHUN LALU (NOMINAL) =====
            $lastYearQuery = DB::table('po')
                ->join('detailpo', 'po.nopo', '=', 'detailpo.nopo')
                ->select(
                    DB::raw('MONTH(po.tglpo) as bulan'),
                    DB::raw('COALESCE(SUM(detailpo.total), 0) as total_nominal')
                )
                ->where('detailpo.nopart', $selected_part_id)
                ->whereYear('po.tglpo', $last_year)
                ->groupBy(DB::raw('MONTH(po.tglpo)'))
                ->orderBy('bulan')
                ->get();

            if ($lastYearQuery->isNotEmpty()) {
                $has_comparison_data = true;
                foreach ($lastYearQuery as $row) {
                    $bulan = (int)$row->bulan - 1; // Adjust untuk array index
                    $last_year_data[$bulan] = (float)$row->total_nominal;
                    $total_last_year += (float)$row->total_nominal;
                }
            }

            // ===== LOGIKA PERSENTASE PERUBAHAN =====
            $percentage_change = 0;
            $percentage_class = 'text-success';

            if ($has_comparison_data && $total_last_year > 0) {
                $percentage_change = (($total_current_year - $total_last_year) / $total_last_year) * 100;
                $percentage_class = $percentage_change >= 0 ? 'text-success' : 'text-danger';
            } else {
                $percentage_change = null;
            }
        }

        // ===== 6. Performance Line Chart - Surat Jalan per hari =====
        // Ambil data untuk minggu ini (Monday-Sunday)
        $current_week_start = Carbon::now()->startOfWeek()->format('Y-m-d');
        $current_week_end = Carbon::now()->endOfWeek()->format('Y-m-d');
        
        // Ambil data untuk minggu lalu
        $last_week_start = Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d');
        $last_week_end = Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d');
        
        // Array hari dalam seminggu
        $days_of_week = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
        $full_days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        // Data untuk minggu ini
        $current_week_data = array_fill(0, 7, 0);
        $currentWeekData = DB::table('suratjalan')
            ->select(
                DB::raw('DAYNAME(tglpengiriman) as hari'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereBetween('tglpengiriman', [$current_week_start, $current_week_end])
            ->groupBy(DB::raw('DAYNAME(tglpengiriman)'))
            ->get();

        foreach ($currentWeekData as $row) {
            $index = array_search($row->hari, $full_days);
            if ($index !== false) {
                $current_week_data[$index] = (int)$row->jumlah;
            }
        }

        // Data untuk minggu lalu
        $last_week_data = array_fill(0, 7, 0);
        $lastWeekData = DB::table('suratjalan')
            ->select(
                DB::raw('DAYNAME(tglpengiriman) as hari'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereBetween('tglpengiriman', [$last_week_start, $last_week_end])
            ->groupBy(DB::raw('DAYNAME(tglpengiriman)'))
            ->get();

        foreach ($lastWeekData as $row) {
            $index = array_search($row->hari, $full_days);
            if ($index !== false) {
                $last_week_data[$index] = (int)$row->jumlah;
            }
        }

        // ===== 7. Data Stok Kritis =====
        // Total semua item stok
        $total_items = DB::table('stok')->count();
        
        // Item dengan stok CRITICAL (stokakhir < minimumstok)
        $critical_items = DB::table('stok')
            ->whereRaw('stokakhir < minimumstok')
            ->count();
            
        // Item dengan stok LOW (stokakhir < minimumstok * 2)
        $low_items = DB::table('stok')
            ->whereRaw('stokakhir < (minimumstok * 2)')
            ->whereRaw('stokakhir >= minimumstok') // Tidak termasuk critical
            ->count();
            
        // Hitung persentase stok kritis
        $critical_percentage = $total_items > 0 ? ($critical_items / $total_items) * 100 : 0;
        
        // Items yang perlu restock (low stock + critical)
        $restock_items = $low_items + $critical_items;

        // ===== 8. Menu Access =====
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'stok' => ['PPIC', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
            'invoice' => ['Finance', 'Manager'],
            'laporan' => ['Finance', 'Manager']
        ];

        // ===== 9. Calculate user metrics =====
        // METRIK 1: Your Today's Work
        $today_count = 0;
        $today_change_text = '+0%';
        $today_change_class = 'text-success';
        
        if ($user) {
            $todayWork = DB::select("
                SELECT COUNT(*) as count FROM (
                    SELECT idpetugas FROM suratjalan 
                    WHERE idpetugas = ? AND DATE(tglpengiriman) = CURDATE()
                    UNION ALL
                    SELECT idpetugas FROM po 
                    WHERE idpetugas = ? AND DATE(tglpo) = CURDATE()
                ) as docs
            ", [$user->id, $user->id]);
            
            $today_count = $todayWork[0]->count ?? 0;
            $today_change_text = '+0%';
            $today_change_class = 'text-success';
        }

        // METRIK 2: Your This Week
        $this_week = 0;
        $week_change_text = '0%';
        $week_change_class = 'text-warning';
        
        if ($user) {
            $thisWeekQuery = DB::select("
                SELECT COUNT(*) as count FROM suratjalan 
                WHERE idpetugas = ? 
                AND YEARWEEK(tglpengiriman, 1) = YEARWEEK(CURDATE(), 1)
            ", [$user->id]);
            
            $lastWeekQuery = DB::select("
                SELECT COUNT(*) as count FROM suratjalan 
                WHERE idpetugas = ? 
                AND YEARWEEK(tglpengiriman, 1) = YEARWEEK(DATE_SUB(CURDATE(), INTERVAL 1 WEEK), 1)
            ", [$user->id]);
            
            $this_week = $thisWeekQuery[0]->count ?? 0;
            $last_week_count = $lastWeekQuery[0]->count ?? 0;
            
            if ($last_week_count > 0) {
                $change = (($this_week - $last_week_count) / $last_week_count) * 100;
                $week_change_text = round($change, 1) . '%';
                if ($change > 0) {
                    $week_change_text = '+' . $week_change_text;
                    $week_change_class = 'text-success';
                } elseif ($change < 0) {
                    $week_change_class = 'text-danger';
                } else {
                    $week_change_class = 'text-warning';
                }
            } else {
                $week_change_text = '0%';
                $week_change_class = 'text-warning';
            }
        }

        // METRIK 3: Your Efficiency
        $efficiency_title = "Your Efficiency";
        $efficiency_value = "0%";
        $efficiency_subtext = "0/0";
        $efficiency_color = "text-muted";
        $efficiency_icon = "mdi-speedometer";
        
        if ($user && isset($departemen)) {
            $dept = strtoupper($departemen);
            
            if ($dept == 'MARKETING') {
                $efficiency_title = "Your PO Efficiency";
                $efficiency_icon = "mdi-clipboard-check";
                
                $efficiencyData = DB::select("
                    SELECT COUNT(*) as total, 
                    COUNT(CASE WHEN deliveryschedule IS NOT NULL AND tglpo <= deliveryschedule THEN 1 END) as ontime 
                    FROM po WHERE idpetugas = ? AND tglpo >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                ", [$user->id]);
                
                if ($efficiencyData && $efficiencyData[0]->total > 0) {
                    $total = $efficiencyData[0]->total;
                    $ontime = $efficiencyData[0]->ontime;
                    $eff = ($ontime / $total) * 100;
                    $efficiency_value = round($eff, 1) . '%';
                    $efficiency_subtext = $ontime . '/' . $total . ' PO';
                    $efficiency_color = $eff >= 90 ? 'text-success' : ($eff >= 70 ? 'text-warning' : 'text-danger');
                }
                
            } elseif ($dept == 'PPIC') {
                $efficiency_title = "Your SJ Efficiency";
                $efficiency_icon = "mdi-truck-delivery";
                
                $efficiencyData = DB::select("
                    SELECT COUNT(DISTINCT s.nosuratjalan) as total,
                    COUNT(DISTINCT CASE WHEN s.tglpengiriman <= p.deliveryschedule THEN s.nosuratjalan END) as ontime
                    FROM suratjalan s 
                    JOIN po p ON s.nopo = p.nopo
                    WHERE s.idpetugas = ? AND s.tglpengiriman >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                ", [$user->id]);
                
                if ($efficiencyData && $efficiencyData[0]->total > 0) {
                    $total = $efficiencyData[0]->total;
                    $ontime = $efficiencyData[0]->ontime;
                    $eff = ($ontime / $total) * 100;
                    $efficiency_value = round($eff, 1) . '%';
                    $efficiency_subtext = $ontime . '/' . $total . ' SJ';
                    $efficiency_color = $eff >= 95 ? 'text-success' : ($eff >= 85 ? 'text-warning' : 'text-danger');
                }
                
            } elseif ($dept == 'FINANCE') {
                $efficiency_title = "Your Invoice Efficiency";
                $efficiency_icon = "mdi-file-document-check";
                
                $efficiencyData = DB::select("
                    SELECT COUNT(DISTINCT invoice.noinvoice) as total,
                    COUNT(DISTINCT CASE WHEN DATEDIFF(invoice.tgl, suratjalan.tglpengiriman) <= 7 
                    THEN invoice.noinvoice END) as ontime
                    FROM invoice 
                    INNER JOIN suratjalan ON invoice.nopo = suratjalan.nopo
                    WHERE invoice.idpetugas = ? AND invoice.tgl >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                ", [$user->id]);
                
                if ($efficiencyData && $efficiencyData[0]->total > 0) {
                    $total = $efficiencyData[0]->total;
                    $ontime = $efficiencyData[0]->ontime;
                    $eff = ($ontime / $total) * 100;
                    $efficiency_value = round($eff, 1) . '%';
                    $efficiency_subtext = $ontime . '/' . $total . ' Inv';
                    $efficiency_color = $eff >= 95 ? 'text-success' : ($eff >= 80 ? 'text-warning' : 'text-danger');
                }
                
            } elseif ($dept == 'MANAGER') {
                $efficiency_title = "Overall Efficiency";
                $efficiency_icon = "mdi-chart-line";
                
                $efficiencyData = DB::select("
                    SELECT 
                    (SELECT COALESCE(COUNT(CASE WHEN deliveryschedule IS NOT NULL AND tglpo <= deliveryschedule THEN 1 END) * 100.0 / 
                            NULLIF(COUNT(*), 0), 0) FROM po WHERE MONTH(tglpo)=MONTH(CURDATE())) as po_eff,
                    (SELECT COALESCE(COUNT(CASE WHEN sj.tglpengiriman <= p.deliveryschedule THEN 1 END) * 100.0 / 
                            NULLIF(COUNT(*), 0), 0) FROM suratjalan sj
                            INNER JOIN po p ON sj.nopo = p.nopo 
                      WHERE MONTH(sj.tglpengiriman)=MONTH(CURDATE())) as sj_eff
                ");
                
                if ($efficiencyData) {
                    $po = $efficiencyData[0]->po_eff ?? 0;
                    $sj = $efficiencyData[0]->sj_eff ?? 0;
                    $eff = ($po + $sj) / 2;
                    $efficiency_value = round($eff, 1) . '%';
                    $efficiency_subtext = "PO:" . round($po,0) . "% SJ:" . round($sj,0) . "%";
                    $efficiency_color = $eff >= 85 ? 'text-success' : ($eff >= 70 ? 'text-warning' : 'text-danger');
                }
            }
        }

        // METRIK 4: Your PO Value
        $user_po_value = 'Rp 0';
        $po_value_change = 'Medium';
        $po_value_change_class = 'text-warning';
        
        if ($user) {
            $poValueData = DB::select("
                SELECT 
                COALESCE(SUM(p.total), 0) as total_value,
                COUNT(p.nopo) as count_po
                FROM po p
                WHERE p.idpetugas = ?
                AND MONTH(p.tglpo) = MONTH(CURDATE())
                AND YEAR(p.tglpo) = YEAR(CURDATE())
            ", [$user->id]);
            
            if ($poValueData) {
                $total_value = $poValueData[0]->total_value ?? 0;
                $count_po = $poValueData[0]->count_po ?? 0;
                
                $avg_value = $count_po > 0 ? $total_value / $count_po : 0;
                
                if ($avg_value >= 1000000) {
                    $user_po_value = 'Rp ' . number_format($avg_value / 1000000, 1) . ' jt';
                } elseif ($avg_value >= 1000) {
                    $user_po_value = 'Rp ' . number_format($avg_value / 1000, 1) . ' rb';
                } else {
                    $user_po_value = 'Rp ' . number_format($avg_value, 0);
                }
                
                if ($avg_value >= 5000000) {
                    $po_value_change_class = 'text-success';
                    $po_value_change = 'High';
                } elseif ($avg_value >= 1000000) {
                    $po_value_change_class = 'text-warning';
                    $po_value_change = 'Medium';
                } else {
                    $po_value_change_class = 'text-info';
                    $po_value_change = 'Low';
                }
            }
        }

        // METRIK 5: Your Accuracy
        $user_accuracy = '0%';
        $accuracy_change = 'No Data';
        $accuracy_change_class = 'text-muted';
        
        if ($user) {
            $accuracyData = DB::select("
                SELECT 
                COUNT(CASE WHEN s.nopol IS NOT NULL AND s.nopol != '' THEN 1 END) as complete,
                COUNT(*) as total,
                CASE 
                    WHEN COUNT(*) > 0 THEN 
                        (COUNT(CASE WHEN s.nopol IS NOT NULL AND s.nopol != '' THEN 1 END) * 100.0 / COUNT(*))
                    ELSE 0 
                END as accuracy
                FROM suratjalan s
                WHERE s.idpetugas = ?
                AND s.tglpengiriman >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
            ", [$user->id]);
            
            if ($accuracyData && $accuracyData[0]->total > 0) {
                $accuracy = $accuracyData[0]->accuracy ?? 0;
                $user_accuracy = round($accuracy, 1) . '%';
                
                if ($accuracy >= 95) {
                    $accuracy_change_class = 'text-success';
                    $accuracy_change = 'Excellent';
                } elseif ($accuracy >= 80) {
                    $accuracy_change_class = 'text-warning';
                    $accuracy_change = 'Good';
                } else {
                    $accuracy_change_class = 'text-danger';
                    $accuracy_change = 'Need Improve';
                }
            }
        }

        // METRIK 6: Your Activity Score
        $user_score = '0';
        $score_change = 'No Activity';
        $score_change_class = 'text-muted';
        
        if ($user) {
            $scoreData = DB::select("
                SELECT 
                COALESCE(COUNT(DISTINCT DATE(s.tglpengiriman)), 0) as active_days,
                COALESCE(COUNT(s.nosuratjalan), 0) as total_sj,
                COALESCE(AVG(CASE WHEN s.tglpengiriman <= p.deliveryschedule THEN 10 ELSE 5 END), 5) as time_score
                FROM suratjalan s
                LEFT JOIN po p ON s.nopo = p.nopo
                WHERE s.idpetugas = ?
                AND s.tglpengiriman >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            ", [$user->id]);
            
            if ($scoreData) {
                $active_days = $scoreData[0]->active_days ?? 0;
                $total_sj = $scoreData[0]->total_sj ?? 0;
                $time_score = $scoreData[0]->time_score ?? 5;
                
                $day_score = $active_days * 10; // Max 70
                $doc_score = min($total_sj * 5, 30); // Max 30
                
                $total_score = min(100, ($day_score + $doc_score + $time_score));
                $user_score = round($total_score, 0);
                
                if ($total_score >= 80) {
                    $score_change_class = 'text-success';
                    $score_change = 'Excellent';
                } elseif ($total_score >= 60) {
                    $score_change_class = 'text-warning';
                    $score_change = 'Good';
                } else {
                    $score_change_class = 'text-danger';
                    $score_change = 'Improve';
                }
            }
        }

        // Return data ke view
        return view('dashboard', [
            'namadepan' => $namadepan,
            'namapetugas' => $namapetugas,
            'email' => $email,
            'departemen' => $departemen,
            
            // Data utama
            'invoice_count' => $invoice_count,
            'today_count' => $today_count,
            'today_change_text' => $today_change_text,
            'today_change_class' => $today_change_class,
            
            'this_week' => $this_week,
            'week_change_text' => $week_change_text,
            'week_change_class' => $week_change_class,
            
            'efficiency_title' => $efficiency_title,
            'efficiency_value' => $efficiency_value,
            'efficiency_subtext' => $efficiency_subtext,
            'efficiency_color' => $efficiency_color,
            'efficiency_icon' => $efficiency_icon,
            
            // Chart data
            'status_labels' => $status_labels,
            'status_data' => $status_data,
            
            'po_status_labels' => $po_status_labels,
            'po_status_data' => $po_status_data,
            'po_status_colors_array' => $po_status_colors_array,
            
            // Market Overview
            'selected_part_id' => $selected_part_id,
            'selected_part_name' => $selected_part_name,
            'parts' => $parts,
            'total_current_year' => $total_current_year,
            'percentage_change' => $percentage_change,
            'percentage_class' => $percentage_class ?? 'text-success',
            'has_comparison_data' => $has_comparison_data,
            'current_year_data' => $current_year_data,
            'last_year_data' => $last_year_data,
            'chart_labels' => $chart_labels,
            
            // Stok data
            'critical_percentage' => round($critical_percentage, 1),
            'restock_items' => $restock_items,
            
            // Performance line
            'days_of_week' => $days_of_week,
            'current_week_data' => $current_week_data,
            'last_week_data' => $last_week_data,
            'current_week_range' => date('d M', strtotime($current_week_start)) . ' - ' . date('d M', strtotime($current_week_end)),
            'last_week_range' => date('d M', strtotime($last_week_start)) . ' - ' . date('d M', strtotime($last_week_end)),
            
            // Additional metrics
            'user_po_value' => $user_po_value,
            'po_value_change' => $po_value_change,
            'po_value_change_class' => $po_value_change_class,
            
            'user_accuracy' => $user_accuracy,
            'accuracy_change' => $accuracy_change,
            'accuracy_change_class' => $accuracy_change_class,
            
            'user_score' => $user_score,
            'score_change' => $score_change,
            'score_change_class' => $score_change_class,
            
            // Menu access
            'menuAccess' => $menuAccess,
        ]);
    }
}