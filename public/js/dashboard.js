
$(function() {
    console.log("=== DASHBOARD.JS DIMULAI ===");
    
    // 1. CEK ELEMENT DOUGHNUT CHART
    console.log("Mencari element #doughnutChart...");
    
    if (typeof dynamicDoughnutData !== 'undefined') {
        console.log("✓ Data dinamis ditemukan:", dynamicDoughnutData);
        
        // 2. CEK ELEMENT DOUGHNUT CHART
        if ($("#doughnutChart").length) {
            console.log("✓ Element #doughnutChart ditemukan");
            
            // 3. BUAT CHART dengan style asli
            var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
            
            // Hapus chart lama jika ada
            if (window.doughnutChartInstance) {
                console.log("Menghapus chart lama...");
                window.doughnutChartInstance.destroy();
            }
            
            // Data dengan style asli
            var doughnutPieData = {
                datasets: [{
                    // Gunakan data dari PHP
                    data: dynamicDoughnutData.datasets[0].data,
                    
                    // Gunakan warna dari PHP jika ada, jika tidak gunakan warna asli
                    backgroundColor: dynamicDoughnutData.datasets[0].backgroundColor || [
                        "#1F3BB3",
                        "#FDD0C7", 
                        "#52CDFF",
                        "#81DADA"
                    ],
                    
                    // Gunakan border color dari style asli
                    borderColor: [
                        "#1F3BB3",
                        "#FDD0C7",
                        "#52CDFF", 
                        "#81DADA"
                    ],
                }],

                // Labels dari PHP
                labels: dynamicDoughnutData.labels || ['OPEN', 'PARTIAL', 'CLOSED']
            };
            
            // Opsi TEPAT SAMA dengan style asli
            var doughnutPieOptions = {
                cutoutPercentage: 50,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                legend: false,
                legendCallback: function (chart) {
                    var text = [];
                    text.push('<div class="chartjs-legend"><ul class="justify-content-center">');
                    for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                        text.push('<li><span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '">');
                        text.push('</span>');
                        if (chart.data.labels[i]) {
                            text.push(chart.data.labels[i] + ': ' + chart.data.datasets[0].data[i]);
                        }
                        text.push('</li>');
                    }
                    text.push('</ul></div>');
                    return text.join("");
                },
                
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return data['labels'][tooltipItem[0]['index']];
                        },
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[0].data[tooltipItem.index];
                            return label + ': ' + value + ' PO';
                        }
                    },
                    
                    backgroundColor: '#fff',
                    titleFontSize: 14,
                    titleFontColor: '#0B0F32',
                    bodyFontColor: '#737F8B',
                    bodyFontSize: 11,
                    displayColors: false
                }
            };
            
            // Buat chart
            console.log("Membuat Doughnut Chart dengan style asli...");
            window.doughnutChartInstance = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
            
            // Update legend dengan data dinamis
            if ($('#doughnut-chart-legend').length) {
                $('#doughnut-chart-legend').html(window.doughnutChartInstance.generateLegend());
            }
            
            console.log("✓ Doughnut Chart BERHASIL dibuat dengan style asli!");
            
        } else {
            console.log("✗ Element #doughnutChart TIDAK DITEMUKAN!");
        }
        
    } else {
        console.warn("⚠ Data dinamis (dynamicDoughnutData) tidak ditemukan!");
    }

    // 2. STATUS SUMMARY CHART dengan data dinamis
    if ($("#status-summary").length) {
        console.log("Membuat Status Summary Chart...");
         // Cek apakah ada data dinamis untuk status summary
        var statusLabels = ["SUN", "MON", "TUE", "WED", "THU", "FRI"];
        var statusData = [0, 0, 0, 0, 0, 0]; // Default kosong
        
        if (typeof statusSummaryChartData !== 'undefined') {
            console.log("✓ Data status summary ditemukan:", statusSummaryChartData);
            statusLabels = statusSummaryChartData.labels;
            statusData = statusSummaryChartData.data;
        } else {
            console.warn("⚠ Data status summary tidak ditemukan, menggunakan default");
        }
        
        var statusSummaryChartCanvas = document.getElementById("status-summary").getContext('2d');
        
        // Hapus chart lama jika ada
        if (window.statusSummaryChartInstance) {
            console.log("Menghapus status summary chart lama...");
            window.statusSummaryChartInstance.destroy();
        }
        
        if ($("#status-summary").length) {
    var statusSummaryChartCanvas = document.getElementById("status-summary").getContext('2d');
    
    // BUAT GRADIENT SEPERTI PERFORMANCE LINE
    var statusGradient = statusSummaryChartCanvas.createLinearGradient(0, 0, 0, 100);
    statusGradient.addColorStop(0, 'rgba(255, 204, 0, 0.3)');
    statusGradient.addColorStop(1, 'rgba(255, 204, 0, 0.05)');
    
    var statusData = {
        labels: ["SUN", "MON", "TUE", "WED", "THU", "FRI"],
        datasets: [{
            label: 'Invoice',
            data: [50, 68, 70, 10, 12, 80],
            backgroundColor: statusGradient, // GRADIENT, BUKAN SOLID
            borderColor: '#01B6A0',
            borderWidth: 1.5, // UBAH DARI 2 KE 1.5
            fill: false, // TRUE UNTUK AREA FILL
            
            // TITIK TIDAK TERLIHAT
            pointBorderWidth: 0,
            pointRadius: 0, // SEMUA 0
            pointHoverRadius: 0,
            pointBackgroundColor: 'transparent',
            pointBorderColor: 'transparent',
        }]
    };

    var statusOptions = {
      responsive: true,
      maintainAspectRatio: false,
        scales: {
            yAxes: [{
              display:false,
                gridLines: {
                    display: false,
                    drawBorder: false,
                    color:"#F0F0F0"
                },
                ticks: {
                  beginAtZero: true,
                  suggestedMin: 0,
                  autoSkip: true,
                  maxTicksLimit: 4,
                  fontSize: 10,
                  color:"#6B778C"
                }
            }],
            xAxes: [{
              display:false,
              gridLines: {
                  display: false,
                  drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                fontSize: 10,
                color:"#6B778C"
              }
          }],
        },
        legend:false,
        
        // INI YANG BIKIN SOFT!
        elements: {
            line: {
                tension: 0.4, // GARIS MELENGKUNG
            },
            point: {
                radius: 0 // TITIK TIDAK TERLIHAT
            }
        },
        tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 0.9)',
            callbacks: {
                label: function(tooltipItem, data) {
                    return 'Invoice: ' + data.datasets[0].data[tooltipItem.index];
                }
            }
        }
    }
    var statusSummaryChart = new Chart(statusSummaryChartCanvas, {
        type: 'line',
        data: statusData,
        options: statusOptions
    });
  }
          
          console.log("✓ Status Summary Chart BERHASIL dibuat dengan style asli!");
      } else {
          console.log("✗ Element #status-summary TIDAK DITEMUKAN!");
      }

    // 3. MARKET OVERVIEW CHART - FORMAT RUPIAH SEPERTI DASHBOARD.JS ($)
if ($("#marketingOverview").length) {
    console.log("Membuat Market Overview Chart...");
    
    // Default values seperti di dashboard.js asli
    var marketLabels = ["JAN","FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    var lastYearData = [1100000, 2200000, 2000000, 1900000, 2200000, 1100000, 2100000, 1100000, 2050000, 2020000, 2010000, 1500000];
    var currentYearData = [2150000, 2900000, 2100000, 2500000, 2900000, 2300000, 2900000, 2100000, 2800000, 2200000, 1900000, 3000000];
    var hasComparisonData = true;
    
    // Gunakan data dinamis jika ada
    if (typeof marketOverviewChartData !== 'undefined') {
        console.log("✓ Data market overview ditemukan:", marketOverviewChartData);
        
        marketLabels = marketOverviewChartData.labels || marketLabels;
        currentYearData = marketOverviewChartData.currentYearData || currentYearData;
        lastYearData = marketOverviewChartData.lastYearData || lastYearData;
        hasComparisonData = marketOverviewChartData.hasComparisonData || false;
        
        // Update info dengan format Rupiah
        if (marketOverviewChartData.totalCurrentYear !== undefined) {
            // Format ke Rupiah
            var formattedCurrent = formatRupiah(marketOverviewChartData.totalCurrentYear);
            $("#total-current-year").text(formattedCurrent);
        }
        
        // Update persentase jika ada
        if (marketOverviewChartData.percentageChange !== null && marketOverviewChartData.percentageClass) {
            var percentageText = '(' + (marketOverviewChartData.percentageChange >= 0 ? '+' : '') + 
                               marketOverviewChartData.percentageChange.toFixed(1) + '%)';
            $("#percentage-change")
                .text(percentageText)
                .removeClass('text-success text-danger text-muted')
                .addClass(marketOverviewChartData.percentageClass);
        } else {
            $("#percentage-change").text('(+0.0%)').addClass('text-muted');
        }
        
        console.log("✓ Labels:", marketLabels);
        console.log("✓ Last Year Data:", lastYearData);
        console.log("✓ Current Year Data:", currentYearData);
        console.log("✓ Has Comparison:", hasComparisonData);
    } else {
        console.warn("⚠ Data market overview tidak ditemukan, menggunakan default");
    }
    
    var marketingOverviewChartCanvas = document.getElementById("marketingOverview").getContext('2d');
    
    // Hapus chart lama jika ada
    if (window.marketingOverviewChartInstance) {
        console.log("Menghapus market overview chart lama...");
        window.marketingOverviewChartInstance.destroy();
    }
    
    // ===== BUAT DATASETS BERDASARKAN KETERSEDIAAN DATA =====
    var datasets = [];
    
    // Dataset 1: Tahun Ini (selalu ada)
    datasets.push({
        label: 'This year',
        data: currentYearData,
        backgroundColor: "#1F3BB3", // BIRU TUA - SAMA PERSIS "This week"
        borderColor: '#1F3BB3',
        borderWidth: 0,
        fill: true,
    });
    
    // Dataset 2: Tahun Lalu (hanya jika ada data)
    if (hasComparisonData) {
        datasets.push({
            label: 'Last year',
            data: lastYearData,
            backgroundColor: "#52CDFF", // BIRU MUDA - SAMA PERSIS "Last week"
            borderColor: '#52CDFF',
            borderWidth: 0,
            fill: true,
        });
    }
    
    var marketingOverviewData = {
        labels: marketLabels,
        datasets: datasets
    };

    // ===== OPTIONS SAMA PERSIS DENGAN DASHBOARD.JS ASLI =====
    var marketingOverviewOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: false,
                    color:"#F0F0F0",
                    zeroLineColor: '#F0F0F0',
                },
                ticks: {
                    beginAtZero: true,
                    autoSkip: true,
                    maxTicksLimit: 5,
                    fontSize: 10,
                    color:"#6B778C",
                    // FORMAT RUPIAH DI Y-AXIS
                    callback: function(value) {
                        if (value >= 1000000) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + ' jt';
                        } else if (value >= 1000) {
                            return 'Rp ' + (value / 1000).toFixed(0) + ' rb';
                        } else {
                            return 'Rp ' + value;
                        }
                    }
                }
            }],
            xAxes: [{
                stacked: true, // Bar chart bertumpuk
                barPercentage: 0.35, // Lebar bar 35%
                gridLines: {
                    display: false,
                    drawBorder: false,
                },
                ticks: {
                    beginAtZero: false,
                    autoSkip: true,
                    maxTicksLimit: 12,
                    fontSize: 10,
                    color:"#6B778C"
                }
            }],
        },
        legend: false,
        legendCallback: function (chart) {
            var text = [];
            text.push('<div class="chartjs-legend"><ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
                console.log(chart.data.datasets[i]); // see what's inside the obj.
                text.push('<li class="text-muted text-small">');
                text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
                text.push(chart.data.datasets[i].label);
                text.push('</li>');
            }
            text.push('</ul></div>');
            return text.join("");
        },
        
        // ELEMENTS LINE - SAMA PERSIS
        elements: {
            line: {
                tension: 0.4,
            }
        },
        
        // TOOLTIP SAMA PERSIS DENGAN FORMAT RUPIAH
        tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
            callbacks: {
                label: function(tooltipItem, data) {
                    var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                    var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                    return datasetLabel + ': ' + formatRupiah(value);
                }
            }
        }
    };
    
    // Buat chart
    console.log("Membuat Market Overview Chart dengan NOMINAL Rupiah...");
    window.marketingOverviewChartInstance = new Chart(marketingOverviewChartCanvas, {
        type: 'bar',
        data: marketingOverviewData,
        options: marketingOverviewOptions
    });
    
    // Update legend
    if ($('#marketing-overview-legend').length) {
        $('#marketing-overview-legend').html(window.marketingOverviewChartInstance.generateLegend());
    }
    
    console.log("✓ Market Overview Chart BERHASIL dibuat dengan NOMINAL Rupiah!");
} else {
    console.log("✗ Element #marketingOverview TIDAK DITEMUKAN!");
}

// ===== FUNGSI FORMAT RUPIAH =====
function formatRupiah(angka) {
    if (!angka) return 'Rp 0';
    
    // Format ke Rupiah
    var number_string = angka.toString();
    var split = number_string.split('.');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    
    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp ' + rupiah;
}


    
    // 4. PERFORMANCE LINE CHART - SURAT JALAN PER HARI
if ($("#performaneLine").length) {
    console.log("Membuat Performance Line Chart...");
    
    // Default values tanpa Sunday
    var performanceLabels = ["MON", "TUE", "WED", "THU", "FRI", "SAT"];
    var currentWeekData = [110, 60, 290, 200, 115, 130];
    var lastWeekData = [150, 190, 250, 120, 150, 130];
    
    // Gunakan data dinamis jika ada
    if (typeof performanceLineChartData !== 'undefined') {
        console.log("✓ Data performance line chart ditemukan:", performanceLineChartData);
        
        // Format data untuk chart (setiap hari CUKUP SATU titik)
        var formattedLabels = [];
        var formattedCurrentWeekData = [];
        var formattedLastWeekData = [];
        
        if (performanceLineChartData.labels && performanceLineChartData.currentWeekData && performanceLineChartData.lastWeekData) {
            // Filter hanya Monday to Saturday
            var daysToShow = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
            
            for (var i = 0; i < daysToShow.length; i++) {
                var day = daysToShow[i];
                var dayIndex = performanceLineChartData.labels.indexOf(day);
                
                if (dayIndex !== -1) {
                    // Cukup satu label per hari
                    formattedLabels.push(day);
                    
                    // Cukup satu data point per hari
                    formattedCurrentWeekData.push(performanceLineChartData.currentWeekData[dayIndex]);
                    formattedLastWeekData.push(performanceLineChartData.lastWeekData[dayIndex]);
                }
            }
            
            performanceLabels = formattedLabels;
            currentWeekData = formattedCurrentWeekData;
            lastWeekData = formattedLastWeekData;
            
            console.log("✓ Formatted Labels (1 titik per hari):", performanceLabels);
            console.log("✓ Formatted Current Week Data:", currentWeekData);
            console.log("✓ Formatted Last Week Data:", lastWeekData);
            
            // UPDATE TANGGAL RANGE (di bawah subtitle)
            if (performanceLineChartData.currentWeekRange) {
                // Gunakan ID khusus untuk performance date range
                if ($("#performance-date-range").length) {
                    $("#performance-date-range").html(
                        "Periode:  (" + performanceLineChartData.currentWeekRange + 
                        ") - (" + performanceLineChartData.lastWeekRange + ")"
                    );
                }
            }
        }
    } else {
        console.warn("⚠ Data performance line chart tidak ditemukan, menggunakan default");
    }
    
    var graphGradient = document.getElementById("performaneLine").getContext('2d');
    var graphGradient2 = document.getElementById("performaneLine").getContext('2d');
    
    // Buat gradient SAMA PERSIS DENGAN DASHBOARD.JS
    var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
    saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
    saleGradientBg.addColorStop(1, 'rgba(26, 115, 232, 0.02)');
    
    var saleGradientBg2 = graphGradient2.createLinearGradient(100, 0, 50, 150);
    saleGradientBg2.addColorStop(0, 'rgba(0, 208, 255, 0.19)');
    saleGradientBg2.addColorStop(1, 'rgba(0, 208, 255, 0.03)');
    
    // Hapus chart lama jika ada
    if (window.performanceLineChartInstance) {
        console.log("Menghapus performance line chart lama...");
        window.performanceLineChartInstance.destroy();
    }
    
    // ===== DATA DENGAN SATU TITIK PER HARI =====
    var salesTopData = {
        labels: performanceLabels,
        datasets: [{
            label: 'This week',
            data: currentWeekData,
            backgroundColor: saleGradientBg,
            borderColor: ['#1F3BB3'],
            borderWidth: 1.5,
            fill: true,
            pointBorderWidth: 1,
            // SATU TITIK PER HARI - disesuaikan jumlahnya
            pointRadius: new Array(performanceLabels.length).fill(4),
            pointHoverRadius: new Array(performanceLabels.length).fill(2),
            pointBackgroundColor: new Array(performanceLabels.length).fill('#1F3BB3'),
            pointBorderColor: new Array(performanceLabels.length).fill('#fff'),
        },{
            label: 'Last week',
            data: lastWeekData,
            backgroundColor: saleGradientBg2,
            borderColor: ['#52CDFF'],
            borderWidth: 1.5,
            fill: true,
            pointBorderWidth: 1,
            // SATU TITIK PER HARI - dengan pattern seperti dashboard.js asli
            pointRadius: new Array(performanceLabels.length).fill(0).map((_, i) => i === 2 ? 4 : 0), // Titik hanya di index ke-2 (WED)
            pointHoverRadius: new Array(performanceLabels.length).fill(0).map((_, i) => i === 2 ? 2 : 0),
            pointBackgroundColor: new Array(performanceLabels.length).fill('#52CDFF'),
            pointBorderColor: new Array(performanceLabels.length).fill('#fff'),
        }]
    };

    // ===== OPTIONS SAMA PERSIS DENGAN DASHBOARD.JS ASLI =====
    var salesTopOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: false,
                    color:"#F0F0F0",
                    zeroLineColor: '#F0F0F0',
                },
                ticks: {
                    beginAtZero: true, // Mulai dari 0
                    autoSkip: true,
                    maxTicksLimit: 10,
                    fontSize: 10,
                    color:"#6B778C",
                    stepSize: 1, // Langkah 1 untuk bilangan bulat
                    callback: function(value) {
                        // Pastikan nilai integer
                        if (value % 1 === 0) {
                            return value + ' surat';
                        }
                        return ''; // Sembunyikan nilai desimal
                    }
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false,
                    drawBorder: false,
                },
                ticks: {
                    beginAtZero: false,
                    autoSkip: true,
                    maxTicksLimit: 6, // Sesuaikan dengan jumlah hari
                    fontSize: 10,
                    color:"#6B778C"
                }
            }],
        },
        legend: false,
        legendCallback: function (chart) {
            var text = [];
            text.push('<div class="chartjs-legend"><ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
                text.push('<li>');
                text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
                text.push(chart.data.datasets[i].label);
                text.push('</li>');
            }
            text.push('</ul></div>');
            return text.join("");
        },
        
        elements: {
            line: {
                tension: 0.4, // Ini yang membuat garis melengkung lebih soft
            }
        },
        
        tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
            callbacks: {
                label: function(tooltipItem, data) {
                    var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                    var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                    return datasetLabel + ': ' + Math.round(value) + ' surat jalan'; // Bulatkan nilai
                }
            }
        }
    };
    
    // Buat chart
    console.log("Membuat Performance Line Chart dengan data surat jalan...");
    window.performanceLineChartInstance = new Chart(graphGradient, {
        type: 'line',
        data: salesTopData,
        options: salesTopOptions
    });
    
    // Update legend SAMA PERSIS DENGAN DASHBOARD.JS
    if ($('#performance-line-legend').length) {
        $('#performance-line-legend').html(window.performanceLineChartInstance.generateLegend());
    }
    
    console.log("✓ Performance Line Chart BERHASIL dibuat!");
    console.log("✓ Jumlah hari: " + performanceLabels.length);
    console.log("✓ Labels: " + performanceLabels);
} else {
    console.log("✗ Element #performaneLine TIDAK DITEMUKAN!");
}

        if ($('#totalVisitors').length) {
      var criticalPercentage = 0;
      var percentageText = $('#totalVisitors').closest('.card-body').find('.fw-bold').first().text();
      if (percentageText) {
          criticalPercentage = parseFloat(percentageText.replace('%', '')) || 0;
      }
      var normalizedPercentage = Math.min(criticalPercentage / 100, 1);
      
      var bar = new ProgressBar.Circle(totalVisitors, {
        color: '#fff',
        strokeWidth: 15,
        trailWidth: 15,
        easing: 'easeInOut',
        duration: 1400,
        text: {
          autoStyleContainer: false
        },
        from: {
          color: '#52CDFF',
          width: 15
        },
        to: {
          color: '#677ae4',
          width: 15
        },
        step: function(state, circle) {
          circle.path.setAttribute('stroke', state.color);
          circle.path.setAttribute('stroke-width', state.width);

          var value = Math.round(circle.value() * 100);
          if (value === 0) {
            circle.setText('');
          } else {
            circle.setText(value);
          }
        }
      });

      bar.text.style.fontSize = '0rem';
      bar.animate(normalizedPercentage);
    }
    if ($('#visitperday').length) {
      var itemsCount = 0;
      var itemsText = $('#visitperday').closest('.card-body').find('.fw-bold').last().text();
      if (itemsText) {
          itemsCount = parseInt(itemsText) || 0;
      }
      var normalizedItems = Math.min(itemsCount / 100, 1);
      
      var bar = new ProgressBar.Circle(visitperday, {
        color: '#fff',
        strokeWidth: 15,
        trailWidth: 15,
        easing: 'easeInOut',
        duration: 1400,
        text: {
          autoStyleContainer: false
        },
        from: {
          color: '#34B1AA',
          width: 15
        },
        to: {
          color: '#677ae4',
          width: 15
        },
        step: function(state, circle) {
          circle.path.setAttribute('stroke', state.color);
          circle.path.setAttribute('stroke-width', state.width);

          var value = Math.round(circle.value() * 100);
          if (value === 0) {
            circle.setText('');
          } else {
            circle.setText(value);
          }
        }
      });

      bar.text.style.fontSize = '0rem';
      bar.animate(normalizedItems);
    }
    

    console.log("=== DASHBOARD.JS SELESAI ===");
});