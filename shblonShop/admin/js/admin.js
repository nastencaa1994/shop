function init(){
	$.post(
	'core.php',
	{
		"action":'init'
	},
	showGoods
	);
}
function showGoods(data){
	data=JSON.parse(data);
	var out="<select><option data-id='0'>Новый товар</option>";
	for(var id in data){
		out+=`<option data-id='${id}'>${data[id].name}</option>`;	
	}
	out+='</select>';
	$('.goods-out').html(out);
	$('.goods-out').on('change',selectGoods);
}
function selectGoods(){
	var id=$('.goods-out select option:selected').attr('data-id');
	$.post(
		"core.php",
		{
			"action":"selectOneGoods",
			"gid":id
		},
		function(data){
			data=JSON.parse(data);
			$('#gname').val(data.name);
			$('#gcost').val(data.cost);
			$('#gdescr').val(data.description);
			$('#gimg').val(data.img);
			$('#gorder').val(data.ord);
			$('#gid').val(data.id);
		}
	);
}
function saveToDb(){
	var id=$('#gid').val();
	if(id!=0){
		$.post(
			'core.php',
			{
				'action': 'updateGoods',
				'id':id,
				'gname':$('#gname').val(),
				'gcost':$('#gcost').val(),
				'gdescr':$('#gdescr').val(),
				'gimg':$('#gimg').val(),
				'gorder':$('#gorder').val()
			},
			function(data){
				if(data==1){
					alert('изменения сохранены');
					init();
				}
				else{
					console.log(data);
				}
			}
		);
	}
	else{
		$.post(
			'core.php',
			{
				'action': 'newGoods',
				'id':0,
				'gname':$('#gname').val(),
				'gcost':$('#gcost').val(),
				'gdescr':$('#gdescr').val(),
				'gimg':$('#gimg').val(),
				'gorder':$('#gorder').val()
			},
			function(data){
				console.log(data);
				if(data=='1'){
					alert('Запись добавлена');
					init();
				}
				else{
				}
			}
		);
	}
}
function delGoods(){
var id=$('#gid').val();
	if(id!=0){
		$.post(
			'core.php',{
				'action': 'delGoods',
				'id':id
			},
			function(data){
				alert('позиция удалена');
				init();
			}
		);
	}	
}
$(document).ready(function(){
	init();
	$('.add-to-db').on('click',saveToDb);
	$('.del-to-db').on('click',delGoods);
})