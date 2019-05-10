<div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
    @include(
        'component.cost-summary-block',
        [
            'icon' => $icon,
            'uri' => $uri,
            'heading' => $heading,
            'subheading' => $subheading,
            'description' => $description,
            'value' => $value
        ]
    )
</div>
