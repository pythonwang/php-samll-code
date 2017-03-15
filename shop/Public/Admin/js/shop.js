$(function(){
	
	/**
	 * 点击获取坐标
	 */
	$('#getPoint').click(function(){
		if($('#shopcoord').val() == ''){
			alert('请填写一个地址')
		}
		var adds = $('#shopcoord').val();
		getPoint(adds);
	})
})
function getPoint(adds){
	var myGeo = new BMap.Geocoder();
	// 将地址解析结果显示在地图上,并调整地图视野
	myGeo.getPoint(adds, function(point){
		$('#shopcoord').val(JSON.stringify(point));
		
	}, "北京市");
}
