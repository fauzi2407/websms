<link rel="stylesheet" type="text/css" href="<?=base_url("assets/dojo/dojo/resources/dojo.css")?>"/>
<link rel="stylesheet" type="text/css" href="<?=base_url("assets/dojo/dijit/themes/claro/claro.css")?>"/>
<link rel="stylesheet" type="text/css" href="<?=base_url("assets/dojo/dojox/grid/enhanced/resources/claro/EnhancedGrid.css")?>"/>
<link rel="stylesheet" type="text/css" href="<?=base_url("assets/dojo/dojox/grid/enhanced/resources/EnhancedGrid_rtl.css")?>"/>

<script type="text/javascript">
dojo.require("dojox.grid.EnhancedGrid");
dojo.require("dojox.grid.enhanced.plugins.Filter");
dojo.require("dojo.data.ItemFileReadStore");
dojo.require("dojo.data.ItemFileWriteStore");

var grid = null,
	connecter = [];
var gridArgs = {
};

var layout = [
		//5 kinds of datatype: string, number, date, time, boolean 'ReceivingDateTime, SenderNumber, TextDecoded, Flag'
		{ field: "ReceivingDate", name:"Tanggal", width: '75px', datatype:"string"},
		{ field: "ReceivingTime", name:"Jam", width: '75px', datatype:"string"},
		{ field: "SenderNumber", name:"Pengirim", width: '110px', datatype:"string"},
		{ field: "TextDecoded", name:"Isi Pesan", width: '210px', datatype:"string"},
		{ field: "Flag", name:"Flag", width: '25px', datatype:"string"}
	];

var plugins = {
	filter: {
		closeFilterbarButton: false,
		ruleCount: 1
	}
};
var jsonInbox = new dojo.data.ItemFileWriteStore({url: "<?=site_url('inbox/jsonInbox')?>"});

dojo.addOnLoad(function() {
	dojo.connect(dojo._listener, "add", function(obj, event, context, method){
		connecter.push([obj, event, context, method]); // Handle
	});

	grid = new dojox.grid.EnhancedGrid(
		dojo.mixin({
			id: "grid",
			store: jsonInbox,
			structure: layout,
			editable: false,
			onRowDblClick: function(){alert(this.rowIndex);},
			style: 'width: 104%; height: 500px;',
			plugins : plugins
		}, gridArgs));

	dojo.byId("gridContainer").appendChild(grid.domNode);
	grid.startup();
});
</script>