

</head>

<body>

{include file="../common_inc/modulesmenu.tpl"}

{include file="inc/menuleft.tpl" method="index"}

{include file="inc/menucommands.tpl" method="index"}

{*include file="../common_inc/toolbar.tpl"*}



<div class="mainfull">
	<form action="{$html->url('/translations/index')}" method="post">
		<input type="hidden" name="data[id]" value="{$object_translation.id.status|default:''}"/>
		<input type="hidden" name="data[master_id]" value="{$object_master.id|default:''}"/>
	{t}Show translations in{/t}:
	<select style="font-size:1.2em;" name="data[translation_lang]">
		<option value="">{t}all languages{/t}</option>
	{foreach key=val item=label from=$conf->langOptions}
		<option value="{$val}">{$label}</option>
	{/foreach}
	</select>
	{t}with status{/t}:
	<select style="font-size:1.2em;" name="data[translation_status]">
	<option value="">{t}on,off,draft,required{/t}</option>
	<option value="on">{t}on{/t}</option>
	<option value="off">{t}off{/t}</option>
	<option value="draft">{t}draft{/t}</option>
	<option value="required">{t}todo{/t}</option>
	</select>
	<br/>
	
	{t}Translations for object id{/t}:
	<input type="text" name="data[translation_object_id]"/>
	
	<input type="submit" value="{t}Refresh data{/t}"/>
	</form>
	<br/>
	
	{if !empty($translations)}
	<table class="indexlist bordered">	
	<tr>
		<th>{t}Object Id{/t}</th>
		<th>{t}Title{/t}</th>
		<th>{t}Lang{/t}</th>
		<th>{t}Status{/t}</th>
		<th>{t}Type{/t}</th>
	</tr>
	{foreach from=$translations item=i key=k}
	{assign var="ot" value=$objects_translated[$i.LangText.object_id][$i.LangText.lang].BEObject.object_type_id}
	<tr class="rowList" rel="{$html->url('/translations/view/')}{$i.LangText.object_id}/{$i.LangText.lang}">
		<td>{$i.LangText.object_id}</td>
		<td>{$translations_title[$i.LangText.object_id][$i.LangText.lang]}</td>
		<td>{$i.LangText.lang}</td>
		<td>{$i.LangText.text}</td>
		<td>{$conf->objectTypeModels[$ot]}</td>
	</tr>
	{/foreach}
	</table>
	{else}
	{t}No translation found{/t}
	{/if}

<br/><br/>
	<h2>TODO</h2>
	le operazioni di massa sono le stesse di tutti gli object...
	cambia status ed eliminazione (no tree)
	<br />
	il link al dettaglio è <a href="{$html->url('/translations/view/')}">QUESTO</a>
</div>
