## Explode

An ExpressionEngine plugin to split a string by any separator


### Installation

Drop the explode folder in your app's `system/user/addons` directory


### Usage

Use {exp:explode} tag pairs in your templates to parse out delimited strings. The default mode is to loop over the parsed results:

    {exp:explode separator="," string="Monday,Tuesday,Any other day"}
        <li>{exp_count}: {exp_value}</li>
        {if exp_count == exp_total_count}Last Item!{/if}
    {/exp:explode}

Which would render:

    <li>1: Monday</li>
    <li>2: Tuesday</li>
    <li>3: Any other day</li>
    Last Item!

You can also enable looping over results by using the loop parameter:

    {exp:explode separator=":" string="value : Label" loop="no"}
        {exp_value_2}
    {/exp:explode}



### EE Version Support

ExpressionEngine 3+

### Acknowledgement

This addon is an adaptation of the plugin by [Isaac Raway](https://devot-ee.com/add-ons/explode)
