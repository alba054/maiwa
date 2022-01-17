<div>
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Data Sakit</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . ($page = '#')) }}"><i
                            class="fe fe-layers mr-2 fs-14"></i>Monitoring</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Data Sakit</a>
                </li>
            </ol>
        </div>
        <div class="page-rightheader">
            <div class="btn btn-list">
                <button wire:click="openSearchModal" class="btn btn-outline-danger"><i class="fe fe-search mr-1"></i>
                    Pencarian
                </button>
                <button wire:click="exportToExcel" class="btn btn-outline-success"><i class="fe fe-printer"></i>
                    Export to Excel</button>

            </div>
        </div>
    </div>
    <!--End Page header-->


    <div class="row">
        <div class="position-relative col-xl-12 col-lg-12">
            <div class="card mb-5 border-0 shadow-sm">
                <div class="card-body">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fe fe-search text-primary"></i>
                                </div>
                            </div>
                            <input wire:keydown.escape="resetQuery" wire:model.debounce.500ms="query" type="text"
                                class="form-control" placeholder="Type Sapi name or Eartag....">
                        </div>
                    </div>
                </div>
            </div>

            <div wire:loading class="card position-absolute mt-1 border-0" style="z-index: 1;left: 0;right: 0;">
                <div class="card-body shadow">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($query))
                <div wire:click="resetQuery" class="position-fixed w-100 h-100"
                    style="left: 0; top: 0; right: 0; bottom: 0;z-index: 1;"></div>
                @if ($search_results->isNotEmpty())
                    <div class="card position-absolute mt-1" style="z-index: 2;left: 0;right: 0;border: 0;">
                        <div class="card-body shadow">
                            <ul class="list-group list-group-flush">
                                @foreach ($search_results as $result)
                                    <li class="list-group-item list-group-item-action">
                                        <a wire:click="resetQuery" wire:click.prevent="selectSapi({{ $result->id }})"
                                            href="#">
                                            {{ 'MBC-' . $result->generasi . '.' . $result->anak_ke . '-' . $result->eartag_induk . '-' . $result->eartag }}
                                            | {{ $result->nama_sapi }}
                                        </a>
                                    </li>
                                @endforeach
                                @if ($search_results->count() >= $how_many)
                                    <li class="list-group-item list-group-item-action text-center">
                                        <a wire:click.prevent="loadMore" class="btn btn-primary btn-sm" href="#">
                                            Load More <i class="bi bi-arrow-down-circle"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="card position-absolute mt-1 border-0" style="z-index: 1;left: 0;right: 0;">
                        <div class="card-body shadow">
                            <div class="alert alert-warning mb-0">
                                No Sapi Found....
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>


        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tabel Sakit</div>
                    <div class="card-options">
                        <select class="custom-select" wire:model="rows">
                            <option value="5">5 Rows</option>
                            <option value="10">10 Rows</option>
                            <option value="50">50 Rows</option>
                            <option value="100">100 Rows</option>
                            <option value="250">250 Rows</option>
                            <option value="500">500 Rows</option>


                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover card-table table-vcenter text-nowrap">

                            @if (count($datas) != 0)
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Waktu</th>
                                        <th>Sapi</th>
                                        <th>Status</th>
                                        <th>Peternak</th>
                                        <th>Pendamping</th>
                                        <th>TSR</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ 'MBC-' . $item->sapi->generasi . '.' . $item->sapi->anak_ke . '-' . $item->sapi->eartag_induk . '-' . $item->sapi->eartag }}
                                            </td>
                                            <td>{{ $item->status }}</td>

                                            <td>{{ $item->peternak->nama_peternak }}</td>
                                            <td>{{ $item->pendamping->user->name }}
                                            </td>
                                            <td>{{ $item->tsr->user->name }}</td>
                                            <td class="text-right">

                                                @if ($item->keterangan == 'Sakit')
                                                    <i wire:click="setSembuh({{ $item->sapi_id }}, {{ $item->id }})"
                                                        class="fe fe-check f-16 btn btn-outline-primary"
                                                        style="cursor:pointer"></i>
                                                @endif


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                There no Data Yet
                            @endif



                        </table>
                        {{ $datas->links() }}


                    </div>

                    <div class="dimmer active" style="height: 5px; margin-top: 0;" wire:loading>
                        <div class="spinner4">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12" wire:ignore>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Data Sakit</h3>

                </div>
                <div class="card-body">


                    <div class="row mb-3">
                        <div class="col-xl-3 col-6">
                            <p class="mb-1">Total Perlakuan</p>
                            <h3 class="mb-0 fs-20 number-font1"> </h3>

                        </div>


                    </div>
                    <div id="echart2" class="chart-tasks chart-dropshadow text-center"></div>
                    <div class="text-center mt-2">

                        <span><span class="dot-label bg-warning"></span>Data Sakit</span>
                    </div>
                </div>
            </div>
        </div>



        <!-- User Form Modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="search-form-modal">
            <div class="modal-dialog" role="document">
                @livewire('mati.wire-mon-mati-search')
            </div>
        </div>
        <!-- User Form Modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="add-form-modal">
            <div class="modal-dialog" role="document">
                @livewire('mati.wire-mon-mati-add')
            </div>
        </div>

    </div>

</div>
@push('script')


    <!--INTERNAL ECharts js-->
    <script src="{{ URL::asset('assets/plugins/echarts/echarts.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var data = @this.datax;
            var dataLabel = @this.dataLabel;
            console.log('data ' + dataLabel);

            /* E-chart */
            var chartdata = [

                {
                    name: 'Data Kinerja',
                    type: 'line',
                    smooth: true,
                    data: data,
                    itemStyle: {
                        normal: {
                            barBorderRadius: [50, 50, 0, 0],
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [{
                                        offset: 0,
                                        color: '#ecb403'
                                    },
                                    {
                                        offset: 1,
                                        color: '#ecb403'
                                    }
                                ]
                            )
                        }
                    },
                },


            ];
            var chart = document.getElementById('echart2');

            var barChart = echarts.init(chart);
            var option = {
                grid: {
                    top: '6',
                    right: '0',
                    bottom: '17',
                    left: '40',
                },
                xAxis: {
                    data: dataLabel,
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(67, 87, 133, .09)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#8e9cad'
                    }
                },
                tooltip: {
                    show: true,
                    showContent: true,
                    alwaysShowContent: true,
                    triggerOn: 'mousemove',
                    trigger: 'axis',
                    axisPointer: {
                        label: {
                            show: false,
                        }
                    }

                },
                yAxis: {
                    splitLine: {
                        lineStyle: {
                            color: 'rgba(67, 87, 133, .09)'
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(67, 87, 133, .09)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#8e9cad'
                    }
                },
                series: chartdata,
                color: ['#ef6430', '#2205bf']
            };
            barChart.setOption(option);
            /* E-chart */
        });
    </script>


@endpush
