var cart={};
function init(){
	//вычитуем файл Goods.json
	//$.getJSON("Goods.json", goodsOut);
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
	console.log(data);
	var out='';
	for(var key in data){
		out+='<div class="cart">';
		out+='<button class="later"data-id="'+data[key].id+'">&#9829</button>';
		out+='<p class="name"><a href="..\\str\\Goods.html#'+data[key].id+'">'+data[key].name+'</a></p>';
		out+='<img src="img\\'+data[key].img+'"alt=""width="100%"height="53%"/>';
		out+='<div class="cost">'+data[key].cost+'</div>';
		out+='<button class="add-to-cart"data-id="'+data[key].id+'">Купить</button>';
		out+='</div>';
		//--------
		// out+='<div class="cart">';
		// out+=`<p class="name">${data[key].name}</p>`;
		// out+=`<img src="img\\${data[key].img}"alt=""width="100%"height="53%"/>`;
		// out+=`<div class="cost">${data[key].cost}</div>`;
		// out+=`<button class="add-to-cart"data-id="${key}">Купить</button>`;
		// out+='</div>';
	}
	$('.Goods-out').html(out);
	$('.add-to-cart').on('click',addToCart);
	$('.later').on('click',addLater);
}
function addLater(){
	// добовляю товар в желания
	var later={};
	if(localStorage.getItem('later')){
		//если есть -расшифровываю и записываю переменную later
		later=JSON.parse(localStorage.getItem('later'));
	}
	alert('Добавлено в желания');
	var id=$(this).attr('data-id');
	later[id]=1;
	localStorage.setItem('later',JSON.stringify(later));
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
})
