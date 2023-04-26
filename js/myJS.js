function reSetlty() {
    setTimeout(function() {
        $('.selectpicker').selectpicker('refresh');
        $('.selectpicker').selectpicker('render');
    });
};


function myTissue(divID, Tissuedata, spe) {
    var names_arr = [];
    var nx_arr = [];
    var Tissuedata = eval(Tissuedata);
    for(var i = 0; i < Tissuedata.length; i++){
        //console.log(Tissuedata[i]);
        names_arr.push(Tissuedata[i].Tissue);
        nx_arr.push(Tissuedata[i].NX);
    }
    //console.log(names_arr);
    //console.log(nx_arr);
    if(spe=='Mouse'){
        var yname = 'log2(TPM)';
    }else{
        var yname = 'NX';
    }
    var myChart = echarts.init(document.getElementById(divID));
    option = {
        xAxis: {
            type: 'category',
            name: 'Tissue',
            data: names_arr,
            minInterval: 1,
            maxInterval: 1,
            axisLabel: {
                interval:0,
                rotate: 45,
                // borderColor:'#ffffff', // 背景色
                // borderWidth:4, // 加边框
                // interval:0
            },
            nameTextStyle: {
                fontFamily : 'Arial',
                color: 'black',
                fontWeight : 'bolder',
                fontSize : 14,
            },
        },
        yAxis: {
            type: 'value',
            name: yname,
            nameTextStyle: {
                fontFamily : 'Arial',
                color: 'black',
                fontWeight : 'bolder',
                fontSize : 14,
            },
        },
        series: [{
            data: nx_arr,
            type: 'bar',
            barWidth: 10,
            showBackground: true,
            backgroundStyle: {
                color: 'rgba(220, 220, 220, 0.8)'
            }
        }],
        //color: '#377eb8',
        color: '#2b77b9',
        grid: {
            bottom:'150'
        },
        tooltip: {
            padding: 10,
            backgroundColor: '#222',
            borderColor: '#777',
            borderWidth: 1,
            formatter: function (obj) {
                // console.log(obj);
                var value = obj.value;
                return  obj.name + " : " + value + ' '+ yname

            }
        }
    };

    myChart.setOption(option);
}

