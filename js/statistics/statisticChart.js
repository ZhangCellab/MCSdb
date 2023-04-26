//statistic pie chart 1
$(document).ready(function(){


    $("#pie1").highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            margin: [65, 0, 95, 0]
        },
        title: {
            text: 'MCS distribution of protein entries',
            style: {
                color: 'black',
                fontSize: '17px',
                fontWeight: 'bold',
                fontFamily: "Arial"
            }
        },
        tooltip: {
            headerFormat: '{series.data.name}<br>',
            pointFormat: '{point.name}: <b>{point.percentage:.2f}%</b>'
        },
        credits: {
            enabled:false
        },
        exporting: {
            enabled:false
        },
        legend : {
            itemStyle : {
                color: 'black',
                fontSize: '14px',
                fontWeight: 'normal',
                fontFamily: "Arial"
            },
            // marginBottom: 200
        },
        plotOptions: {
            pie: {
                startAngle: -50,
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    // format: '<b>{point.name}</b>: {point.percentage:.2f}%',

                    formatter: function () {
                        return this .point.name + ": " + Highcharts.numberFormat( this .y, 0 , ' , ' )
                    },

                    style: {
                        color: 'black',
                        fontSize: '14px',
                        fontWeight: 'normal',
                        fontFamily: "Arial"
                    }

                    // style: {
                    //     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    // }
                },
                showInLegend: true  // 显示在图例中
            }
        },
        series: [{
            type: 'pie',
            name: 'Entries proportions',
            data: [
                {
                    name: 'ER-MT',
                    y: 6230,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#3288bd',
                },
                {
                    name: 'ER-PM',
                    y: 116,
                    sliced: true,  // 突出显示某个扇区，表示强调
                    color: '#f46d43',
                },
                {
                    name: 'ER-Endosome',
                    y: 41,
                    sliced: true,  // 突出显示某个扇区，表示强调
                    color: '#5e4fa2',
                },
                {
                    name: 'ER-LD',
                    y: 34,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#66c2a5',
                },
                {
                    name: 'ER-GA',
                    y: 21,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#abdda4',
                },
                {
                    name: 'ER-Peroxisome',
                    y: 17,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#f45b5b',
                },
                {
                    name: 'LY-Autophagosome',
                    y: 16,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#fdae61',
                },
                {
                    name: 'ER-LY',
                    y: 16,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#878787',
                },
                {
                    name: 'MT-Peroxisome',
                    y: 11,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#4d4d4d',
                },
                {
                    name: 'Others',
                    y: 89,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#1a1a1a',
                }
            ]
        }]

    });

    $("#bar1").highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Category distribution of protein entries',
            style: {
                color: 'black',
                fontSize: '17px',
                fontWeight: 'bold',
                fontFamily: "Arial"
            }
        },
        xAxis: {
            type: 'category',
            title: {
                text: null
            },
            labels: {
                style: {
                    color: "black",
                    fontSize: "14px",
                    rotation: 45,
                    fontWeight: "normal",
                    fontFamily: "Arial"
                },
                // rotation: -45,  // 设置轴标签旋转角度
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Log2 (Counts)',
                style: {
                    color: "black",
                    fontSize: "14px",
                    fontWeight: "normal",
                    fontFamily: "Arial"
                }
            },
            labels: {
                overflow: 'justify',
                style: {
                    color: "black",
                    fontSize: "14px",
                    fontWeight: "normal",
                    fontFamily: "Arial"
                }
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            formatter: function() {
                oldy=this.point.y;
                if(oldy==12.4906){
                    return  'The number is 5755';
                }else if(oldy==8.6402){
                    return  'The number is 399';
                }else if(oldy==8.7715){
                    return  'The number is 437';
                }else if(oldy==8.388){
                    return  'The number is 335';
                }
            }
            // pointFormat: 'The number is {point.y:.0f}'
        },
        series: [{
            name: '总人口',
            data: [
                ['Mass-spectrometric techniques', 12.4906],
                ['Proximity Labeling Techniques', 8.6402],
                ['Low throughput experimental methods', 8.7715],
                ['Entries involving complexes', 8.388]
            ],
            dataLabels: {
                enabled: true,
                rotation: 0,
                align: 'center',
                // format: '{point.y:.0f}', // :.1f 为保留 1 位小数
                formatter: function() {
                    oldy=this.point.y;
                    if(oldy==12.4906){
                        return  5755;
                    }else if(oldy==8.6402){
                        return  399;
                    }else if(oldy==8.7715){
                        return  437;
                    }else if(oldy==8.388){
                        return  335;
                    }
                },
                y: 5,
                color: "black",
                style: {
                    fontFamily: "Arial",
                    fontWeight: "normal"
                }

            }
        }],
        credits: {
            enabled:false
        }
    });

    $("#pie2").highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            margin: [45, 10, 125, 10]
        },
        title: {
            text: 'Organismal distribution of protein entries',
            style: {
                color: 'black',
                fontSize: '17px',
                fontWeight: 'bold',
                fontFamily: "Arial"
            }
        },
        tooltip: {
            headerFormat: '{series.data.name}<br>',
            pointFormat: '{point.name}:The number is  <b>{point.percentage:.0f}</b>'
        },
        credits: {
            enabled:false
        },
        exporting: {
            enabled:false
        },
        legend : {
            itemStyle : {
                color: 'black',
                fontSize: '14px',
                fontWeight: 'normal',
                fontFamily: "Arial"
            },
            // marginBottom: 200
        },
        plotOptions: {
            pie: {
                startAngle: -50,
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    // format: '<b>{point.name}</b>: {point.percentage:.2f}%',

                    formatter: function () {
                        return this .point.name + ": " + Highcharts.numberFormat( this .y, 0 , ' , ' )
                    },

                    style: {
                        color: 'black',
                        fontSize: '14px',
                        fontWeight: 'normal',
                        fontFamily: "Arial"
                    }
                },
                showInLegend: true  // 显示在图例中
            }
        },
        series: [{
            type: 'pie',
            name: 'Entries proportions',
            data: [
                {
                    name: 'Human',
                    y: 2864,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#3288bd',
                },
                {
                    name: 'Mouse',
                    y: 3603,
                    sliced: true,  // 突出显示某个扇区，表示强调
                    color: '#66c2a5',
                },
                {
                    name: 'Rat',
                    y: 27,
                    sliced: true,  // 突出显示某个扇区，表示强调
                    color: '#5e4fa2',
                },
                {
                    name: 'Yeast',
                    y: 90,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#fc8d59',
                },
                {
                    name: 'Arabidopsis thaliana',
                    y: 7,
                    sliced: false,  // 突出显示某个扇区，表示强调
                    color: '#d53e4f',
                }
            ]
        }]

    });

    $("#bar2").highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Subunit number of complexes reside in MCS',
            style: {
                color: 'black',
                fontSize: '17px',
                fontWeight: 'bold',
                fontFamily: "Arial"
            }
        },
        xAxis: {
            type: 'category',
            title: {
                text: null
            },
            labels: {
                style: {
                    color: "black",
                    fontSize: "14px",
                    rotation: 45,
                    fontWeight: "normal",
                    fontFamily: "Arial"
                },
                // rotation: -45,  // 设置轴标签旋转角度
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Log2 (Counts+1)',
                style: {
                    color: "black",
                    fontSize: "14px",
                    fontWeight: "normal",
                    fontFamily: "Arial"
                }
            },
            labels: {
                overflow: 'justify',
                style: {
                    color: "black",
                    fontSize: "14px",
                    fontWeight: "normal",
                    fontFamily: "Arial"
                }
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            formatter: function() {
                oldy=this.point.y;
                if(oldy==6.858){
                    return  'The number is 115';
                }else if(oldy==5.0444){
                    return  'The number is 32';
                }else if(oldy==4){
                    return  'The number is 15';
                }else if(oldy==3){
                    return  'The number is 7';
                }else if(oldy==1){
                    return  'The number is 1';
                }else if(oldy==2.3219){
                    return  'The number is 4';
                }
            }
            // pointFormat: 'The number is {point.y:.0f}'
        },
        series: [{
            name: '总人口',
            data: [
                ['2', 6.858],
                ['3', 5.0444],
                ['4', 4],
                ['5', 3],
                ['6', 1],
                ['7', 2.3219]
            ],
            dataLabels: {
                enabled: true,
                rotation: 0,
                color: "black",
                style: {
                    fontFamily: "Arial",
                    fontWeight: "normal"
                },
                align: 'center',
                // format: '{point.y:.0f}', // :.1f 为保留 1 位小数
                formatter: function() {
                    oldy=this.point.y;
                    if(oldy==6.858){
                        return  '115';
                    }else if(oldy==5.0444){
                        return  '32';
                    }else if(oldy==4){
                        return  '15';
                    }else if(oldy==3){
                        return  '7';
                    }else if(oldy==1){
                        return  '1';
                    }else if(oldy==2.3219){
                        return  '4';
                    }
                },
                y: 6
            }
        }],
        credits: {
            enabled:false
        }
    });

});

