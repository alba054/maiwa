<script type="text/javascript">
    $(document).ready(function() {
        var data = @this.data;
        console.log(data);

        /* E-chart */
        var chartdata = [


            {
                name: 'Data Sapi Jantan',
                symbolSize: 20,
                barWidth: 10,
                type: 'bar',
                data: [23, 17, 19, 22, 17, 11, 19, 20, 17, 19, 25, 17, 11, 19],
                itemStyle: {
                    normal: {
                        barBorderRadius: [50, 50, 0, 0],
                        color: new echarts.graphic.LinearGradient(
                            0, 0, 0, 1,
                            [{
                                    offset: 0,
                                    color: '#705ec8'
                                },
                                {
                                    offset: 1,
                                    color: '#20c2fa'
                                }

                            ]
                        )
                    }
                },
            },
            {
                name: 'Data Sapi Betina',
                symbolSize: 20,
                barWidth: 10,
                type: 'bar',
                data: [3, 7, 9, 2, 7, 11, 9, 3, 7, 9, 2, 2, 1, 5],
                itemStyle: {
                    normal: {
                        barBorderRadius: [50, 50, 0, 0],
                        color: new echarts.graphic.LinearGradient(
                            0, 0, 0, 1,
                            [{
                                    offset: 0,
                                    color: '#fd6f82'
                                },
                                {
                                    offset: 1,
                                    color: '#fb1c52'
                                }

                            ]
                        )
                    }
                },
            }
        ];
        var chart = document.getElementById('echart3');
        var barChart = echarts.init(chart);
        var option = {
            grid: {
                top: '6',
                right: '0',
                bottom: '17',
                left: '25',
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
