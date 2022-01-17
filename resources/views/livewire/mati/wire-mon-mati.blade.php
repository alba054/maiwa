<div>
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Data Kematian</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . ($page = '#')) }}"><i
                            class="fe fe-layers mr-2 fs-14"></i>Monitoring</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Data Kematian</a>
                </li>
            </ol>
        </div>
        <div class="page-rightheader">
            <div class="btn btn-list">
                <button wire:click="openAddModal" class="btn btn-outline-info"><i class="fe fe-plus mr-1"></i>
                    Tambahkan</button>
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
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tabel Kematian</div>
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
                                        <th>Keterangan</th>
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
                                            <td>{{ $item->keterangan }}</td>

                                            <td>{{ $item->peternak->nama_peternak }}</td>
                                            <td>{{ $item->pendamping->user->name }}
                                            </td>
                                            <td>{{ $item->tsr->user->name }}</td>
                                            <td class="text-right">

                                                <i wire:click="selectedItem({{ $item->id }},'update')"
                                                    class="fe fe-edit f-16 btn btn-outline-success"
                                                    style="cursor:pointer"></i>
                                                <i wire:click="selectedItem({{ $item->id }},'delete')"
                                                    class="fe fe-trash-2 f-16 btn btn-outline-danger"
                                                    style="cursor:pointer"></i>
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
                    <h3 class="card-title">Grafik Data Kematian</h3>

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

                        <span><span class="dot-label bg-warning"></span>Data Kematian</span>
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
            console.log(dataLabel);

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
