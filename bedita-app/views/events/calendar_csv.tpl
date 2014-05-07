{foreach from=$dateItems item=item key=key}
{if !empty($item.DateItem.start_date)}
{$dateprev = $date|default:''}
{$date = $item.DateItem.start_date|date_format:"%A<span class='day'>%d</span> %B <span class='year'>%Y</span>"}
{$now = $smarty.now|date_format:"%a %d %B %Y"}
{if $date != $dateprev}
{$date}
{/if}
{$time = $item.DateItem.start_date|date_format:"%H:%M"}
ore {$time};{$item.DateItem.Event.title|default:''};{$item.DateItem.Event.description|default:''};{$item.DateItem.Event.body|default:''};
{/if}
{/foreach}