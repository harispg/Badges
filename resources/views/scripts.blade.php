

<script src="/js/dropzone.js"></script>
	<script type="text/javascript">
		Dropzone.options.addPhotosToBadge = {
		  paramName: "photo", // The name that will be used to transfer the file
		  maxFilesize: 2, // MB
		  acceptedFiles: '.jpg,.jpeg,.bmp,npg',
		};
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$("#photoGrid").on('click','.check',function(){
				var photoId = "#photo" + $(this).data("photo");
				var realPhotoId = $(this).data("photo");
				$(".active").removeClass('btn btn-sm btn-outline-primary active').addClass('btn btn-sm btn-outline-primary');
				$(this).removeClass('btn btn-sm btn-outline-primary').addClass('btn btn-sm btn-outline-primary active');	
				$.ajax({
					url: '/ajaxPhoto',
					method: 'POST',
					data: {_token: CSRF_TOKEN, photo: realPhotoId},
					success: function(photo){
						$("#avatar").attr("src", "/"+photo.thumbnail_path);
					} 
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$("#photoGrid").on("click",".delete",function(){
				var realPhotoId = $(this).data("photo");
				$.ajax({
					url: '/ajaxDeletePhoto',
					method: 'POST',
					data: {_token: CSRF_TOKEN, photo: realPhotoId},
					success: function(photos){
						renderPictures(photos);
					}
				});
			});

			function renderPictures(photos){
				$("#photoGrid").html("");
				for (var photoNumber = 0; photoNumber < photos.length; photoNumber++) {
					if(photoNumber==0 || photoNumber%4==3){
					if(photos[photoNumber].main_picture){
						$("#avatar").attr("src", "/" + photos[photoNumber].thumbnail_path);
					}
					$("#photoGrid").append("<div class='row' id='photoRow'>");	
					$("#photoRow").append(giveHtml(photos[photoNumber]));
						$("#photoGrid").append("</div>");
					}else{
						if(photos[photoNumber].main_picture){
						$("#avatar").attr("src", "/" + photos[photoNumber].thumbnail_path);
					}
						$("#photoRow").append(giveHtml(photos[photoNumber]));
					}
				}

			}

			function giveHtml(photo){
					var flag='active';
					if(!photo.main_picture){
						var flag='';
					}
					return "<div class='col-md-3' style='display:inline-block; width=25%'><div class='card mb-4 shadow-sm'><img class='card-img-top' src='/"+photo.thumbnail_path+"'id='"+photo.id+"'><div class='card-body'><p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><button type='button' class='delete btn btn-sm btn-outline-secondary' data-photo='"+photo.id+"'>Delete photo</button><button type='submit' class='check btn btn-sm btn-outline-primary "+flag+"' data-photo='"+photo.id+"'>Set Avatar</button></div><small class='text-muted'>9 mins</small> </div></div></div></div>";
			}
		});
	</script>