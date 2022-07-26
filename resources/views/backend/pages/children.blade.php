@if(count($childrens))
    <div class="dd" id="nestable">
        <div id="load"></div>
        <ul class="list-group" id="{!! $depth == 1 ? 'site-map' : 'site-map-'. $depth  !!}" parent="{!! $parent_id !!}" >
            @foreach($childrens as $child)
                <li id="categories_{!! $child->id !!}" class="list-group-item node level-{!! $depth !!} @if ( ! $child->has_children) no-children  @elseif ($child->is_expanded) children-visible @else children-hidden @endif">
                    <div class="page">
                    <span class="w1">
                        @if ($child->children()->count() > 0)
                            <img align="middle" id="expander-{!! $child->id  !!}" class="expander" src="{{ url('/') }}/backend/img/{!! $child->is_expanded ? 'collapse': 'expand' !!}.png" title="" onclick="$.treeMely($(this), '{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/pages/children/' )) }}', 'li#categories_'+{!! $child->id !!}, {!! $child->id !!}, {!! $depth !!}, 'expanded_rows_page');" />
                        @else
                            <img align="middle" id="" class="" src="{{ url('/') }}/backend/img/dot.gif" title="" width="17" />
                        @endif

                        <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/'.$child->id.'/show' )) }}"><span class="title {!! $child->status == 0 ? 'hidden-status' : '' !!}">{!! $child->description()->first()->name !!}</span> <span class="title-small">{{ $arrJenis[$child->jenis] }}</span></a>
                        <img align="middle" alt="" class="busy" id="busy-{!! $child->id  !!}" src="{{ url('/') }}/backend/img/spinner.gif" style="display: none;" title="" />
                    </span>
                    </div>

                    <div class="modify">
                        <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/create/'.$child->id )) }}"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                        <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/'.$child->id.'/edit' )) }} "><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    </div>

                    <?php if ($child->is_expanded) echo $child->children_rows; ?>
                </li>
            @endforeach
        </ul>
    </div>
@endif