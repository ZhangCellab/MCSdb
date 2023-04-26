function get_pie1(id){
    "use strict";
    $('#'+id).highcharts({
        credits: {
            enabled:false
        },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            backgroundColor: 'white',
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            },
           // marginTop: 0,
           // marginBottom: 30,
        },
        title: {
            text: 'Human Interaction Type Distribution',
            marginBottom: 10,
            style:{
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
                'fontSize' : '18px',
            }
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.3f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: false,
                    format: '{point.name}'
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: '',
            // size: "65%",
            data: [
                {
                    name: 'Cell adhesion',
                    y: 1743,
                    // sliced: true,
                    // selected: true
                },
                ['Cytokine-cytokine receptor interaction', 740],

                ['ECM-receptor interaction', 266],
                // ['Intracellular factor to receptor interaction', 25],
                // ['Intracellular factor interaction', 224],
                ['Secreted protein to ECM interaction', 26],
                ['Secreted protein to receptor interaction', 969],
                ['sMOL-receptor interacion', 341]
            ]
        }],
        legend: {
            //margin: 0,
            //marginTop: 20,
            //padding: 0,
            // align: 'right',
            // verticalAlign: 'bottom',
            layout: 'horizontal',
            itemStyle : {
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
                'fontSize' : '14px',
                'color' : '#666666'
            }
            //itemDistance: 20,
/*            x: 45,
            y: 10,*/
        },
        colors:['#984ea3','#377eb8','#4daf4a','#83c7e4','#ff7f00','#dba9e7','#a65628'],
    });
}

function get_pie2(id){
    "use strict";
    $('#'+id).highcharts({
        credits: {
            enabled:false
        },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            backgroundColor: 'white',
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            },
            // marginTop: 0,
            // marginBottom: 30,
        },
        title: {
            text: 'Mouse Interaction Type Distribution',
            marginBottom: 10,
            style:{
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
                'fontSize' : '18px',
            }
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.3f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: false,
                    format: '{point.name}'
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: '',
            // size: "65%",
            data: [
                {
                    name: 'Cell adhesion',
                    y: 1468,
                                        // sliced: true,
                                        // selected: true
                },
                ['Cytokine-cytokine receptor interaction', 691],

                ['ECM-receptor interaction', 261],
                // ['Intracellular factor to receptor interaction', 6],
                // ['Intracellular factor interaction', 144],
                ['Secreted protein to ECM interaction', 26],
                ['Secreted protein to receptor interaction', 795],
                ['sMOL-receptor interacion', 87]
            ]
        }],
        legend: {
            //margin: 0,
            //marginTop: 20,
            //padding: 0,
            // align: 'right',
            // verticalAlign: 'bottom',
            layout: 'horizontal',
            itemStyle : {
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
                'fontSize' : '14px',
                'color' : '#666666'
            }
            //itemDistance: 20,
            /*            x: 45,
                        y: 10,*/
        },
        colors:['#984ea3','#377eb8','#4daf4a','#83c7e4','#ff7f00','#dba9e7','#a65628'],
    });
}

function get_hist1(id){
    "use strict";
    $('#'+id).highcharts({
        credits: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Ligand/Receptor Distribution',
            style:{
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
                'fontSize' : '18px',
            }
        },
        xAxis: {
            categories:  ['ECM', 'Membrane', 'Secreted'],
            crosshair: true,
            labels: {
                style: {
                    fontSize: '12px',
                    'fontFamily' : 'arial',
                    'fontWeight' : 'normal',
                },
            },
        },
        yAxis: {
            min: 0,
            title: {
                text: 'numbers'
            },
            style: {
                fontSize: '12px',
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
            },
        },
        legend: {
            //margin: 0,
            //marginTop: 20,
            //padding: 0,
            // align: 'right',
            // verticalAlign: 'bottom',
            itemStyle : {
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
                'fontSize' : '14px',
            }
            //itemDistance: 20,
            /*            x: 45,
                        y: 10,*/
        },
        tooltip: {
            // head + 每个 point + footer 拼接成完整的 table
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                borderWidth: 0
            }
        },
        series: [{
            name: 'Human',
            data: [68, 1354, 524]
        }, {
            name: 'Mouse',
            data: [67, 1214, 452]
        }]
    });
};

function get_hist2(id) {
    var myChart = echarts.init(document.getElementById(id));
    option = {
        title : {
            show: true,//显示策略，默认值true,可选为：true（显示） | false（隐藏）
            text: 'Statistics of Ligand and Receptor',//主标题文本，'\n'指定换行
            x:'center',
            textStyle: {
                fontFamily: 'arial',
                fontSize: 18,
                fontStyle: 'normal',
                fontWeight: 'normal',
                color: 'black',
            },
        },
        tooltip: {
            padding: 10,
            backgroundColor: '#222',
            borderColor: '#777',
            borderWidth: 1,
            formatter: function (obj) {
                var value = obj.value;
                return  obj.name + " : " + value +  '<br>'

            }
        },
        xAxis: {
            type: 'category',
            minInterval: 1,
            maxInterval: 1,
            axisLabel: {
                interval:0,
                rotate: 45,
            },
            nameTextStyle: {
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
                'fontSize' : '14px',
            },

            data: ['Ligand', 'Receptor']
        },
        yAxis: {
            type: 'value',
            // name: 'numbers',
            nameTextStyle: {
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
                'fontSize' : '14px',
            },
        },
        grid: {
            left: '10%',
            bottom:'25%',
        },
    series: [{
            data: [1873, 1559],
            type: 'bar',
            barWidth: 65,
            showBackground: false,
            // backgroundStyle: {
            //     color: 'rgba(220, 220, 220, 0.8)'
            // }
        }]
    };
    // 使用刚指定的配置项和数据显示图表
    myChart.setOption(option);
}

function get_hist3(id) {
    var myChart = echarts.init(document.getElementById(id));
    option = {
        title : {
            show: true,//显示策略，默认值true,可选为：true（显示） | false（隐藏）
            text: 'Statistics of CoV-human Interaction',//主标题文本，'\n'指定换行
            x:'center',
            textStyle: {
                fontFamily: 'arial',
                fontSize: 18,
                fontStyle: 'normal',
                fontWeight: 'normal',
                color: 'black',
            },
        },
        tooltip: {
            padding: 10,
            backgroundColor: '#222',
            borderColor: '#777',
            borderWidth: 1,
            formatter: function (obj) {
                var value = obj.value;
                return  obj.name + " : " + value +  '<br>'

            }
        },
        xAxis: {
            type: 'category',
            minInterval: 1,
            maxInterval: 1,
            axisLabel: {
                interval:0,
                rotate: 45,
            },
            nameTextStyle: {
                fontFamily : 'Arial',
                color: 'black',
                fontWeight : 'normal',
                fontSize : 14,
            },
            data: ['Interaction', 'Virus-ligand', 'Human-receptor'],
            style: {
                fontSize: '12px',
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
            },
        },
        yAxis: {
            min: 0,
            type : 'value',
            name: 'numbers',
            position: 'left',
            style: {
                fontSize: '14px',
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
            },
            nameTextStyle: {
                //verticalAlign: "middle",
                align: "left",
            },
            nameRotate: 90,
            nameLocation:'center',
            nameGap:40
        },
        grid: {
            left: '10%',
            bottom:'25%',
        },
        series: [{
            data: [16, 5, 14],
            type: 'bar',
            barWidth: 65,
            showBackground: false,
            // backgroundStyle: {
            //     color: 'rgba(220, 220, 220, 0.8)'
            // }
        }],
        color: '#377eb8',
    };
    // 使用刚指定的配置项和数据显示图表
    myChart.setOption(option);
}

function get_hist4(id) {
    var myChart = echarts.init(document.getElementById(id));
    option = {
        title : {
            show: true,//显示策略，默认值true,可选为：true（显示） | false（隐藏）
            text: 'Human sMOL-receptor interaction',//主标题文本，'\n'指定换行
            x:'center',
            textStyle: {
                fontFamily: 'arial',
                fontSize: 18,
                fontStyle: 'normal',
                fontWeight: 'normal',
                color: 'black',
            },
        },
        tooltip: {
            padding: 10,
            backgroundColor: '#222',
            borderColor: '#777',
            borderWidth: 1,
            formatter: function (obj) {
                var value = obj.value;
                return  obj.name + " : " + value +  '<br>'

            }
        },
        xAxis: {
            type: 'category',
            minInterval: 1,
            maxInterval: 1,
            axisLabel: {
                interval:0,
                rotate: 45,
            },
            nameTextStyle: {
                fontFamily : 'Arial',
                color: 'black',
                fontWeight : 'normal',
                fontSize : 14,
            },
            data: ['Interaction', 'Ligand', 'Receptor', 'Complex'],
            style: {
                fontSize: '12px',
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
            },
        },
        yAxis: {
            min: 0,
            type : 'value',
            name: 'numbers',
            position: 'left',
            style: {
                fontSize: '14px',
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
            },
            nameTextStyle: {
                //verticalAlign: "middle",
                align: "left",
            },
            nameRotate: 90,
            nameLocation:'center',
            nameGap:40
        },
        grid: {
            left: '10%',
            bottom:'25%',
        },
        series: [{
            data: [341, 152, 176, 2],
            type: 'bar',
            barWidth: 65,
            showBackground: false,
            // backgroundStyle: {
            //     color: 'rgba(220, 220, 220, 0.8)'
            // }
        }],
        color: '#377eb8',
    };
    // 使用刚指定的配置项和数据显示图表
    myChart.setOption(option);
}

function get_hist5(id) {
    var myChart = echarts.init(document.getElementById(id));
    option = {
        title : {
            show: true,//显示策略，默认值true,可选为：true（显示） | false（隐藏）
            text: 'Mouse sMOL-receptor interaction',//主标题文本，'\n'指定换行
            x:'center',
            textStyle: {
                fontFamily: 'arial',
                fontSize: 18,
                fontStyle: 'normal',
                fontWeight: 'normal',
                color: 'black',
            },
        },
        tooltip: {
            padding: 10,
            backgroundColor: '#222',
            borderColor: '#777',
            borderWidth: 1,
            formatter: function (obj) {
                var value = obj.value;
                return  obj.name + " : " + value +  '<br>'

            }
        },
        xAxis: {
            type: 'category',
            minInterval: 1,
            maxInterval: 1,
            axisLabel: {
                interval:0,
                rotate: 45,
            },
            nameTextStyle: {
                fontFamily : 'Arial',
                color: 'black',
                fontWeight : 'normal',
                fontSize : 14,
            },
            data: ['Interaction', 'Ligand', 'Receptor', 'Complex'],
            style: {
                fontSize: '12px',
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
            },
        },
        yAxis: {
            min: 0,
            type : 'value',
            name: 'numbers',
            position: 'left',
            style: {
                fontSize: '14px',
                'fontFamily' : 'arial',
                'fontWeight' : 'normal',
            },
            nameTextStyle: {
                //verticalAlign: "middle",
                align: "left",
            },
            nameRotate: 90,
            nameLocation:'center',
            nameGap:40
        },
        grid: {
            left: '10%',
            bottom:'25%',
        },
        series: [{
            data: [87, 50, 47, 0],
            type: 'bar',
            barWidth: 65,
            showBackground: false,
            // backgroundStyle: {
            //     color: 'rgba(220, 220, 220, 0.8)'
            // }
        }],
        color: '#377eb8',
    };
    // 使用刚指定的配置项和数据显示图表
    myChart.setOption(option);
}