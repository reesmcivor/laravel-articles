<select name="article" {{ $attributes->merge(['class' => 'your-default-classes-if-any', 'multiple' => 'multiple']) }}>
    {!! $selectOptions !!}
</select>