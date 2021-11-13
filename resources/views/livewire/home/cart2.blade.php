<script type="text/javascript">
    $(document).ready(function() {
        var data = @this.data;
        console.log(data);

        /* E-chart */
        var chartdata = [

            {
                name: 'Data Kinerja',
                type: 'line',
                smooth: true,
                data: [8000, 5000, 15000, 10000, 10000, 8000, 9000, 12000, 5000, 15000, 10000, 10000, 8000,
                    16000
                ],
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
                data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ],
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
