var setting = {
    view: {
        selectedMulti: false,
        fontCss: setFontCss,
        dblClickExpand: false,

    },
    data: {
        key: {
            title:"t",
        },
        simpleData: {
            enable: true,
        }
    },
    callback: {
        beforeClick: beforeClick,
        beforeDblClick: beforeDblClick,
        onClick: onClick,
    },
};

var zNodes = [
    { id:1, pId:1, name:" Arabidopsis thaliana", t:"Interaction Type", open:true},

    { id:11, pId:1, name:"Low throughput experimental methods: 7 entries", name1:"Low throughput experimental methods", y:1},
    { id:12, pId:1, name:"Proximity Labeling Techniques: 0 entries", name1:"Proximity Labeling Techniques", y:1},
    { id:13, pId:1, name:"Mass-spectrometric techniques: 0 entries", name1:"Mass-spectrometric techniques", y:1},

    { id:2, pId:2, name:" Human", t:"Interaction Type", open:true},

    { id:21, pId:2, name:"Low throughput experimental methods: 221 entries", name1:"Low throughput experimental methods", y:2},
    { id:22, pId:2, name:"Proximity Labeling Techniques: 401 entries", name1:"Proximity Labeling Techniques", y:2},
    { id:23, pId:2, name:"Mass-spectrometric techniques: 2,243 entries", name1:"Mass-spectrometric techniques", y:2},


    { id:3, pId:3, name:" Mouse", t:"Interaction Type", open:true},

    { id:31, pId:3, name:"Low throughput experimental methods: 94 entries", name1:"Low throughput experimental methods", y:3},
    { id:32, pId:3, name:"Proximity Labeling Techniques: 0 entries", name1:"Proximity Labeling Techniques", y:3},
    { id:33, pId:3, name:"Mass-spectrometric techniques: 3,508 entries", name1:"Mass-spectrometric techniques", y:3},

    { id:4, pId:4, name:" Rat", t:"Interaction Type", open:true},

    { id:41, pId:4, name:"Low throughput experimental methods: 27 entries", name1:"Low throughput experimental methods", y:4},
    { id:42, pId:4, name:"Proximity Labeling Techniques: 0 entries", name1:"Proximity Labeling Techniques", y:4},
    { id:43, pId:4, name:"Mass-spectrometric techniques: 0 entries", name1:"Mass-spectrometric techniques", y:4},

    { id:5, pId:5, name:" Yeast", t:"Interaction Type", open:true},

    { id:51, pId:5, name:"Low throughput experimental methods: 90 entries", name1:"Low throughput experimental methods", y:5},
    { id:52, pId:5, name:"Proximity Labeling Techniques: 0 entries", name1:"Proximity Labeling Techniques", y:5},
    { id:53, pId:5, name:"Mass-spectrometric techniques: 0 entries", name1:"Mass-spectrometric techniques", y:5},

];

var log, className = "dark";

function beforeClick(treeId, treeNode) {

    var method = treeNode.name1;
    var spe_id = treeNode.pId;
    window.location.href='./php_mysql/getbrowser.php?browserSpe='+spe_id+'&browserMethod='+method;

}
function beforeDblClick(treeId, treeNode) {
    return false;
}
function setFontCss(treeId, treeNode){
    return treeNode.level == 0? {"font-weight":"bold"} : {};
}
function onClick(e,treeId, treeNode) {
    var zTree = $.fn.zTree.getZTreeObj("treeDemo");
    zTree.expandNode(treeNode);
}
$(document).ready(function(){
    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
});
