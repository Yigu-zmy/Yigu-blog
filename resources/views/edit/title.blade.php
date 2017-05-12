

<h3>标题 :</h3>
<input type="edit" style="width: 100%" id="title"
    @if(isset($article))
        value="{{$article->title}}"
            @endif
>
<h3>分类 :</h3>
<select id="category">
    <?php $len = count($categorys)?>
    @for($i = 0; $i < $len; $i++)
    <option value={{$i}}>{{$categorys[$i]->name}}</option>
        @endfor

</select>