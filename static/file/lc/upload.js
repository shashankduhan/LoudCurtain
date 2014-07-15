(function () {
	var formdata = false;

 	/*input.addEventListener("change",lc.upload.ini , false);*/
if(lc){
lc.upload={};
lc.upload.fileType=null;
lc.upload.ini=function(a) {
        var input = document.getElementById(a.filePad);
        if(typeof lc.upload.fileType == undefined){lc.upload.fileType=null;}
 		var i = 0, len = input.files.length, img, file;
        formdata = new FormData(document.getElementById(a.formid));
		for ( ; i < len; i++ ) {
			file = input.files[i];
			if(lc.upload.fileType=='img'){if (!!file.type.match(/image.*/)) {
				if (formdata) {
					formdata.append("images[]", file);
				}
			}else{lc.alert('Please Provide a jpg,jpeg,bmp,png file type only');return false;}}else{if (formdata) {
					formdata.append("images[]", file);
				}}	
		}
	
		if (formdata) {
            formdata.append("action", 'upload');
            formdata.append("location", '');
			new ajax.request("/checkpost.php",{
				method: "POST",
				parameters: formdata,
				processData: false,
				contentType: false,
                onCreate:function(){new lc.indicator.start(a.responsePad,'horzDotLoop','darkgrey');},
				onSuccess: function (res) {
                    document.getElementById(a.filePad).value=null;
                    formdata = new FormData();
                    new lc.indicator.stop(a.responsePad);new lc.alert(res);
                    res=eval("("+res+")");
                    try{new a.onSuccess(res);}catch(e){}
				}
			});
		}
	}
}
}());
