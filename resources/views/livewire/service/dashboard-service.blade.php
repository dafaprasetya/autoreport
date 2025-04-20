<div class="row gy-4">
    <div class="row row-cols-xxl-12 gy-4" wire:poll>
        <div class="col-md-4">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
              <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                  <div>
                    <p class="fw-medium text-primary-light mb-1">Total Pekerjaan</p>
                    <h6 class="mb-0">{{ $totalkerjaan }}</h6>
                  </div>
                  <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="hugeicons:new-job" class="text-white text-2xl mb-0"></iconify-icon>
                  </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    {{ \Carbon\Carbon::parse($tanggal)->format('F Y') }}
                </p>
              </div>
            </div><!-- card end -->
        </div>
        <div class="col-md-4">
            <div class="card shadow-none border bg-gradient-start-1 h-100">
              <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                  <div>
                    <p class="fw-medium text-primary-light mb-1">Selesai</p>
                    <h6 class="mb-0">{{ $selesai }}</h6>
                  </div>
                  <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="ant-design:file-done-outlined" class="text-white text-2xl mb-0"></iconify-icon>
                  </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    {{ \Carbon\Carbon::parse($tanggal)->format('F Y') }}
                </p>
              </div>
            </div><!-- card end -->
        </div>
        <div class="col-md-4">
            <div class="card shadow-none border bg-gradient-start-5 h-100">
              <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                  <div>
                    <p class="fw-medium text-primary-light mb-1">Belum Selesai</p>
                    <h6 class="mb-0">{{ $belumselesai }}</h6>
                  </div>
                  <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="material-symbols:pending-actions" class="text-white text-2xl mb-0"></iconify-icon>
                  </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    {{ \Carbon\Carbon::parse($tanggal)->format('F Y') }}
                </p>
              </div>
            </div><!-- card end -->
        </div>
        <div class="col-xxl-8 col-xl-8" wire:ignore>
            <div class="card h-100 radius-8 border">
                <div class="card-header">
                    <h6 class="fw-semibold text-lg">Lokasi</h6>
                    <div class="d-flex align-items-center gap-2 ">
                        <p class="fw-semibold mb-0">Pekerjaan di Lokasi pada bulan {{ \Carbon\Carbon::parse($tanggal)->format('F Y') }}</p>
                    </div>
                </div>
                <div class="card-body p-24">
                    <div class="mt-20 d-flex justify-content-center flex-wrap gap-3">
                        @foreach ($lokasi as $item)
                        <div class="text-center d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-10 br-hover-primary group-item">
                            <span class="text-secondary-light text-sm fw-medium">{{ $item->nama }}</span>
                            <h6 class="text-md fw-semibold mb-0">{{ $item->jumlah }}</h6>
                        </div>
                        @endforeach
                    </div>
                    <div id="lokasiChart" class="barChart"></div>

                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-4" wire:ignore>
            <div class="card h-100 radius-8 border-0 overflow-hidden">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="fw-bold text-lg">Keterangan</h6>
                    </div>
                </div>
                <div class="card-body p-24">
                    <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-12-px radius-2 bg-primary-600"></span>
                            <span class="text-secondary-light text-sm fw-normal">External
                            </span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                            <span class="text-secondary-light text-sm fw-normal">Internal
                            </span>
                        </li>
                      </ul>
                    <div id="keteranganChart" class="apexcharts-tooltip-z-none"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-12">
            <div class="card header">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="fw-bold text-lg mb-0">Leaderboard bulan {{ \Carbon\Carbon::parse($tanggal)->format('F Y') }}</h6>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mt-32">
                        @foreach ($leaderboard as $item)
                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-medium">{{ $item->user->name }}</h6>
                                    <span class="text-sm text-secondary-light fw-medium">{{ $item->user->email }}</span>
                                </div>
                            </div>
                            <span class="text-primary-light text-md fw-medium">{{ $item->total_poin }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-8" wire:ignore>
            <div class="card h-100 radius-8 border-0">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <div>
                        <h6 class="mb-2 fw-bold text-lg">Total Pekerjaan Disetiap Divisi</h6>
                        <span class="text-sm fw-medium text-secondary-light">Bulan {{ \Carbon\Carbon::parse($tanggal)->format('F Y') }}</span>
                    </div>

                    </div>

                    <div class="mt-20 d-flex justify-content-center flex-wrap gap-3">
                        @foreach ($divisi as $item)
                        <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                            <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                            <iconify-icon icon="uis:chart" class="icon"></iconify-icon>
                            </span>
                            <div>
                            <span class="text-secondary-light text-sm fw-medium">{{ $item->nama }}</span>
                            <h6 class="text-md fw-semibold mb-0">{{ $item->jumlah }}</h6>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div id="divisiChart" class="barChart"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12" wire:ignore>
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Patient Visited by Depertment</h6>
                    </div>
                </div>
                <div class="card-body p-24 d-flex align-items-center gap-16">
                    <div id="jenisPekerjaanChart"></div>
                    <ul class="d-flex flex-column gap-12">
                        <li>
                            <span class="text-lg">Cardiology: <span class="text-primary-600 fw-semibold">80%</span> </span>
                        </li>
                        <li>
                            <span class="text-lg">Psychiatry:  <span class="text-warning-600 fw-semibold">40%</span> </span>
                        </li>
                        <li>
                            <span class="text-lg">Pediatrics: <span class="text-success-600 fw-semibold">10%</span> </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@push('script')
<script>
     var options = {
        series: [80, 40, 10],
        chart: {
            height: 300,
            type: 'radialBar',
        },
        colors: ['#3D7FF9', '#ff9f29', '#16a34a'],
        stroke: {
            lineCap: 'round',
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '10%',  // Adjust this value to control the bar width
                },
                dataLabels: {
                    name: {
                        fontSize: '16px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    // total: {
                    //     show: true,
                    //     formatter: function (w) {
                    //         return '82%'
                    //     }
                    // }
                },
                track: {
                    margin: 20, // Space between the bars
                }
            }
        },
        labels: ['Cardiology', 'Psychiatry', 'Pediatrics'],
    };

    var chart = new ApexCharts(document.querySelector("#jenisPekerjaanChart"), options);
    chart.render();
    var options = {
        series: [{
          name: "Total",
          data: [
                @foreach($divisi as $item)
                    { x: '{{ $item->nama }}', y: {{ $item->jumlah }} }{{ !$loop->last ? ',' : '' }}
                @endforeach
            ]
        }],
      chart: {
          type: 'bar',
          height: 310,
          toolbar: {
              show: false
          }
      },
      plotOptions: {
          bar: {
              borderRadius: 4,
              horizontal: false,
              columnWidth: '23%',
              endingShape: 'rounded',
          }
      },
      dataLabels: {
          enabled: false
      },
      fill: {
          type: 'gradient',
          colors: ['#487FFF'], // Set the starting color (top color) here
          gradient: {
              shade: 'light', // Gradient shading type
              type: 'vertical',  // Gradient direction (vertical)
              shadeIntensity: 0.5, // Intensity of the gradient shading
              gradientToColors: ['#487FFF'], // Bottom gradient color (with transparency)
              inverseColors: false, // Do not invert colors
              opacityFrom: 1, // Starting opacity
              opacityTo: 1,  // Ending opacity
              stops: [0, 100],
          },
      },
      grid: {
          show: true,
          borderColor: '#D1D5DB',
          strokeDashArray: 4, // Use a number for dashed style
          position: 'back',
      },
      xaxis: {
          type: 'category',
          categories: [
            // 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
            @foreach($divisi as $item)
                '{{ $item->nama }}',
            @endforeach
        ]
      },
      yaxis: {
          labels: {
              formatter: function (value) {
                  return value;
              }
          }
      },
      tooltip: {
          y: {
              formatter: function (value) {
                  return value ;
              }
          }
      }
    };

    var chart = new ApexCharts(document.querySelector("#divisiChart"), options);
    chart.render();
    function createChartTwo(chartId, color1, color2) {
        var options = {
            series: [{
                name: ['serries1', 'series2'],
                data: [48, 35, 55, 32, 48, 30, 55, 50, 57]
            }, {
                name: 'series2',
                data: [12, 20, 15, 26, 22, 60, 40, 48, 25]
            }],
            legend: {
                show: false
            },
            chart: {
                type: 'area',
                width: '100%',
                height: 200,
                toolbar: {
                    show: false
                },
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3,
                colors: [color1, color2], // Use two colors for the lines
                lineCap: 'round'
            },
            grid: {
                show: true,
                borderColor: '#D1D5DB',
                strokeDashArray: 1,
                position: 'back',
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                row: {
                    colors: undefined,
                    opacity: 0.5
                },
                column: {
                    colors: undefined,
                    opacity: 0.5
                },
                padding: {
                    top: -20,
                    right: 0,
                    bottom: -10,
                    left: 0
                },
            },
            fill: {
                type: 'gradient',
                colors: [color1, color2], // Use two colors for the gradient
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.5,
                    gradientToColors: [undefined, `${color2}00`], // Apply transparency to both colors
                    inverseColors: false,
                    opacityFrom: [0, 0], // Starting opacity for both colors
                    opacityTo: [0, 0], // Ending opacity for both colors
                    stops: [0, 100],
                },
            },
            markers: {
                colors: [color1, color2], // Use two colors for the markers
                strokeWidth: 3,
                size: 0,
                hover: {
                    size: 10
                }
            },
            xaxis: {
                labels: {
                    show: false
                },
                tooltip: {
                    enabled: false
                },
                labels: {
                    formatter: function (value) {
                        return value;
                    },
                    style: {
                        fontSize: "14px"
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                    return "Total: " + value;
                    },
                    style: {
                    fontSize: "14px"
                    }
                },
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
        chart.render();
    }

    createChartTwo('enrollmentChart', '#487FFF', '#FF9F29');
var options = {
      series: [{
          name: "Total",
          data: [
                @foreach($lokasi as $item)
                    { x: '{{ $item->nama }}', y: {{ $item->jumlah }} }{{ !$loop->last ? ',' : '' }}
                @endforeach
            ]
      }],
      chart: {
          type: 'bar',
          height: 235,
          toolbar: {
              show: false
          },
      },
      plotOptions: {
          bar: {
            borderRadius: 6,
            horizontal: false,
            columnWidth: 24,
            columnWidth: '52%',
            endingShape: 'rounded',
          }
      },
      dataLabels: {
          enabled: false
      },
      fill: {
          type: 'gradient',
          colors: ['#dae5ff'], // Set the starting color (top color) here
          gradient: {
              shade: 'light', // Gradient shading type
              type: 'vertical',  // Gradient direction (vertical)
              shadeIntensity: 0.5, // Intensity of the gradient shading
              gradientToColors: ['#dae5ff'], // Bottom gradient color (with transparency)
              inverseColors: false, // Do not invert colors
              opacityFrom: 1, // Starting opacity
              opacityTo: 1,  // Ending opacity
              stops: [0, 100],
          },
      },
      grid: {
          show: false,
          borderColor: '#D1D5DB',
          strokeDashArray: 4, // Use a number for dashed style
          position: 'back',
          padding: {
            top: -10,
            right: -10,
            bottom: -10,
            left: -10
          }
      },
      xaxis: {
          type: 'category',
          categories: [
            // 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
            @foreach($lokasi as $item)
                '{{ $item->nama }}',
            @endforeach
        ]
      },
      yaxis: {
        show: false,
      },
  };

var chart = new ApexCharts(document.querySelector("#lokasiChart"), options);
chart.render();
var options = {
        series: [
            {{ $internal }}, {{ $eksternal }}
        ],
        colors: [
            '#FF9F29', '#487FFF',
        ],
        labels: [
            'Internal', 'External'
        ] ,
        legend: {
            show: false
        },
        chart: {
            type: 'donut',
            height: 270,
            sparkline: {
            enabled: true // Remove whitespace
            },
            margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
            padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
            }
        },
        stroke: {
            width: 0,
        },
        dataLabels: {
            enabled: false
        },
        responsive: [{
            breakpoint: 480,
            options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
            }
        }],
    };

var chart = new ApexCharts(document.querySelector("#keteranganChart"), options);
chart.render();
</script>
@endpush
