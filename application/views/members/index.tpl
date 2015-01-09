{extends file="members/main.tpl"}

{block name="body"}

	<form action="" method="post">
		<h1>Генериране на Баркод</h1>
		<label>Баркод от номер</label>
		<input name="from" value="" type="text" class="in"/>
		до номер<input name="to" value="" type="text" class="in"/>

		<input name="gen" value="Генерирай" type="submit"/>
	</form>


	{foreach from=$barcodes item=item}
		<img src="{$base_url}{$item}" alt="barcode"/>
	{/foreach}

{/block}