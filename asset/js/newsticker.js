$(function()
{
	var listticker = function()
	{
		setTimeout(function(){
			$('#listticker li:first').animate( {marginTop: '-80px'}, 1200, function()
			{
				$(this).detach().appendTo('div#listticker' ).removeAttr('style');	
			});
			listticker();
		}, 6000);
	};
	listticker();
});

$(function()
{
	var listticker2 = function()
	{
		setTimeout(function(){
			$('#listticker2 li:first').animate( {marginTop: '-80px'}, 1200, function()
			{
				$(this).detach().appendTo('div#listticker2' ).removeAttr('style');	
			});
			listticker2();
		}, 8000);
	};
	listticker2();
});