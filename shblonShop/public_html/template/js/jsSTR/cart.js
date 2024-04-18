var cart={};
function loadCard(){
	//проверяю есть ли в localStorage запись в cart
	if(localStorage.getItem('cart')){
		//если есть -расшифровываю и записываю переменную cart
		cart=JSON.parse(localStorage.getItem('cart'));
		if(isEmpty(cart)==false){
			$('.main-cart').html('Корзина пуста');
		}
		else{
		showCart();}
	}
	else{
		$('.main-cart').html('Корзина пуста');
	}
}

function showCart(){
cart=JSON.parse(localStorage.getItem('cart'));
var a=Object.keys(cart);
		
			
$.post(
		'..\\core\\core.php',
		{
			"action":"showCart",
			'id': a
		},
		showOut
	);
}
function showOut(data){
	console.log(data);
	data=JSON.parse(data);
		var out='';
			for(var key in data){
				out+='<button data-id="'+data[key].id+'"class="del-Goods">x</button>';
				out+='<img src="..\\..\\img\\'+data[key].img+'"width="50px"height="50px"/>';
				out+=''+data[key].name+'';
				out+=''+cart[key]+'';
				out+='  <button data-id="'+data[key].id+'" class="plus-Goods">+</button>  ';
				out+='<button data-id="'+data[key].id+'" class="minus-Goods">-</button>  ';
				out+="Цена - "+cart[key]*data[key].cost;
				out+='<br/>';
			}
			$('.main-cart').html(out);
			$('.del-Goods').on('click',delGoods);
			$('.plus-Goods').on('click',PlusGoods);
			$('.minus-Goods').on('click',MinusGoods);
}

function MinusGoods(){
	//уменьшаем колличество товара
	var id=$(this).attr('data-id');
	if(cart[id]>1){cart[id]--;}
	else{delete cart[id];}
	saveCart();
	loadCard();
}
function PlusGoods(){
	//добавляет количество товара
	var id=$(this).attr('data-id');
	cart[id]++;
	saveCart();
	loadCard();
}
function delGoods(){
	//удаляем товар из корзины
	var id=$(this).attr('data-id');
	delete cart[id];
	saveCart();
	loadCard();
}
function saveCart(){
	//сохраняем карзину в localStorage
	localStorage.setItem('cart',JSON.stringify(cart));//конвертируем карзину в строку
}
function isEmpty(object){
	//проверка на пустоту
	for(var key in object)
	if(object.hasOwnProperty(key))return true;
	return false;
}
function sendEmail(){
	var ename=$('#ename').val();
	var email=$('#email').val();
	var ephone=$('#ephone').val();
	var koment=$('#koment').val();
	if(koment=='')koment=' - ';
	if(ename!=""&&email!=""&&ephone!=""){
		if(isEmpty(cart)==true){
			$.post(
				"core\\mail.php",
				{
					"ename": ename,
					"email": email,
					"ephone":ephone,
					"koment":koment,
					"cart":cart
				},
				function(data){
					console.log(data);
					if(data==1){
					alert("заказ отправлен");
					}
				}
			);
		}
		else{
			alert('корзина пуста');
		}
	}
	else{
		alert('заполните поля');
	}
}
$(document).ready(function(){
	loadCard();
	$('.send-email').on('click',sendEmail);// отправка почты
});