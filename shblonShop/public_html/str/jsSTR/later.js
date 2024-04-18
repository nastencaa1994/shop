var cart={};
function init(){
	//вычитуем файл goods.json
	$.post(
		'..\\core\\core.php',
		{
			"action":"loadGoods"
		},
		goodsOut
	);
}
function goodsOut(data){
	//вывод на странуцу
	data=JSON.parse(data);
	var out='';
	var later={};
	if(localStorage.getItem('later')){
		//если есть -расшифровываю и записываю переменную later
		later=JSON.parse(localStorage.getItem('later'));
		for(var key in later){
		out+='<div class="cart">';
		out+='<button class="del-goods"data-id="'+data[key].id+'">x</button>';
		out+='<p class="name">'+data[key].name+'</p>';
		out+='<img src="..\\img\\'+data[key].img+'"alt=""width="100%"height="53%"/>';
		out+='<div class="cost">'+data[key].cost+'</div>';
		out+='<button class="add-to-cart"data-id="'+data[key].id+'">Отправить в карзину</button>';
		out+='<a href="goods.html#'+data[key].id+'">Посмотреть товар</a>';
		out+='</div>';
		}
		$('.goods-out').html(out);
	}
	else{
		$('.goods-out').html('Список желаний пуст');
		}
	$('.del-goods').on('click',delGoods);
	$('.add-to-cart').on('click',addToCart);
}
function delGoods(){
	//удаляем товар из корзины
	var id=$(this).attr('data-id');
	delete later[id];
	localStorage.setItem('cart',JSON.stringify(later));
	loadCard();
}
function addToCart(){
	//добавляем товар в корзину--------------------------------
	var id=$(this).attr('data-id');
	if(cart[id]==undefined){
		cart[id]=1;
	}
	else{
		cart[id]++;
	}
	showMiniCart();
	saveCart();
}
function saveCart(){
	//сохраняем карзину в localStorage--------------------------------------------
	localStorage.setItem('cart',JSON.stringify(cart));//конвертируем карзину в строку
}
function showMiniCart(){
	//показываем мини карзину
	var out=0;
	for(var key in cart){	
		out++;
	}
	$('.mini-cart').html(out);
}
function loadCard(){
	//проверяю есть ли в localStorage запись в cart
	if(localStorage.getItem('cart')){
		//если есть -расшифровываю и записываю переменную cart
		cart=JSON.parse(localStorage.getItem('cart'));
		showMiniCart();
	}
}
$(document).ready(function(){
	init();
	loadCard();
});
