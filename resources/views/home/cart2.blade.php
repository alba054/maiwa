<script type="text/javascript">
    $(document).ready(function() {
        var data = @json($dataxupah);
        var dataLabel = @json($labelSapi);
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
