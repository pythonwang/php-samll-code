$(function () {
	//删除博文
	$('.del-blog').click(function() {
		var did = $(this).attr('did');
		var isDel = confirm('确认要删除该微博？');
		var obj = $(this).parents('.del');
		if (isDel) {
			$.post(delblog, {did : did}, function(data) {
				if (data) {
					obj.slideUp('slow', function() {
						obj.remove();
					});
				}else{
					alert('删除失败，请重试...');
				}
			},'json');
		}
	});




});