{$view->element('modulesmenu')}

{include file="inc/menuleft.tpl"}

{include file="inc/menucommands.tpl" fixed=true}

<div class="main">
	<div class="tab"><h2>{t}BEdita updates{/t}</h2></div>
	<div id="update-list">
		<table class="indexlist js-header-float">
			<thead>
				<tr>
					<th>Name</th>
					<th>Type</th>
					<th>Folder</th>
					<th></th>
				</tr>
			</thead>
			{foreach from=$paths item=p}
			<tr>
				<td>{$p.name}</td>
				<td>{t}{$p.type}{/t}</td>
				<td>{$p.path}</td>
				<td style="text-align: right"><button class="ajax" rel="{$p.path}">{t}update{/t}</button></td>
			</tr>
			{/foreach}
				
		</table>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	openAtStart("#update-list");

	$(document).delegate('button.ajax', 'click', function() {
		var $_this = $(this);
		var loader = $('<div class="loader">');
		$_this.hide().after(loader);
		loader.width(25).height(25).css('margin', '0 auto').show();
		var op = $_this.attr("rel");
		$.ajax({
			url: "{$html->url('/admin/update')}",
			data: {
				operation: op
			},
			dataType: "json",
			type: "post",
			error: function(jqXHR, textStatus, errorThrown) {

				alert(errorThrown);
				$_this.show();
				loader.remove();
			},
			success: function(data, textStatus, jqXHR) {
				$("#messagesDiv").empty();
				if (data.errorMsg != undefined) {
					//alert(data.errorMsg);
					if (data.htmlMsg != undefined && data.htmlMsg != "") {
						$("#messagesDiv").html(data.htmlMsg).triggerMessage("error");
					}
				} else {
					//alert(data.message);
					if (data.htmlMsg != undefined && data.htmlMsg != "") {
						$("#messagesDiv").html(data.htmlMsg).triggerMessage(data.msgType);
					}
				}

				$_this.show();
				loader.remove();
			}
		});

	});
});
</script>