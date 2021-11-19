<div>
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Panen</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . ($page = '#')) }}"><i
                            class="fe fe-layers mr-2 fs-14"></i>Monitoring</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Panen</a>
                </li>
            </ol>
        </div>
        <div class="page-rightheader">
            <div class="btn btn-list">
                <button wire:click="openAddModal" class="btn btn-info"><i class="fe fe-plus mr-1"></i>
                    Tambahkan</button>
                <button wire:click="openSearchModal" class="btn btn-danger"><i class="fe fe-search mr-1"></i>
                    Pencarian
                </button>

            </div>
        </div>
    </div>
    <!--End Page header-->


    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tabel Panen</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover card-table table-vcenter text-nowrap">

                            @if (count($datas) != 0)
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Waktu Panen</th>
                                        <th>Panen Ke -</th>
                                        <th>Keterangan Panen</th>
                                        <th>Sapi</th>
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
                                            <td>{{ $item->tgl_panen }}</td>
                                            <td>{{ $item->frek_panen }}</td>
                                            <td>{{ $item->ket_panen }}</td>
                                            <td>{{ $item->sapi->eartag }}</td>
                                            <td>{{ $item->peternak->nama_peternak }}</td>
                                            <td>{{ $item->pendamping->user->name }}
                                            </td>
                                            <td>{{ $item->tsr->user->name }}</td>
                                            <td class="text-right">
                                                <i wire:click="selectedItem({{ $item->id }},'export')"
                                                    class="fe fe-list f-16 btn btn-warning" style="cursor:pointer"></i>
                                                <i wire:click="selectedItem({{ $item->id }},'update')"
                                                    class="fe fe-edit f-16 btn btn-success" style="cursor:pointer"></i>
                                                <i wire:click="selectedItem({{ $item->id }},'delete')"
                                                    class="fe fe-trash-2 f-16 btn btn-danger"
                                                    style="cursor:pointer"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                There no Data Yet
                            @endif



                        </table>
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
                    <h3 class="card-title">Grafik Insiminasi Buatan</h3>

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

                        <span><span class="dot-label bg-warning"></span>Data Insiminasi Buatan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Form Modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="search-form-modal">
            <div class="modal-dialog" role="document">
                @livewire('panen.wire-mon-panen-search')
            </div>
        </div>
        <!-- User Form Modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="add-form-modal">
            <div class="modal-dialog" role="document">
                @livewire('panen.wire-mon-panen-add')
            </div>
        </div>

    </div>

</div>
@push('script')


    <!--INTERNAL ECharts js-->
    <script src="{{ URL::asset('assets/plugins/echarts/echarts.js') }}"></script>

    {{-- @include('livewire.home.cart2') --}}

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
