var Buat = function() {
	return{
		El: function(el, atr, text='') {
			var a = document.createElement(el);
			if(typeof atr === "object"){
				$(atr).each(function(i, v){
					if(typeof v === "number"){
						throw new Error("Tipe Key Pada Object Harus Berupa string.\nTipe Yang Dimasukan: "+ typeof i);
					}
				});
				$(a).attr(atr);
			}
			else{
				throw new Error("Parameter #1 Harus Berupa Object {key:value}");
			}
			$(a).html(text);

			return a;
		}
	}
}();