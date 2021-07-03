(function( $ ) {
	'use strict';


	// This enables you to define handlers, for when the DOM is ready:
  $(function () {

    /**
     * hide "unnecessary" areas
     */

    $('.wcfm_product_manager_content_fields, .product_tags, #product_tags, .wcfm_side_tag_cloud, #is_catalog, #is_catalog + p')
      .addClass('amp-hide')
    
    // change product type
    $('#product_type').val('variable')


    /**
     * Making things beutiful
     */

    $('.wcfm_product_manager_gallery_fields').css('width', '100%')

    /**
     * 
     * C A T E G O R I E S
     * 
     */

	let category_nodes = {}
    
    // select categories
    $('.wcfm-checkbox.checklist_type_product_cat').each(function (index) {
      const category = $(this)

      category_nodes[[category.val()]] = category
		
      $('#amp_root').append(function () {
        // console.log(`${index} ${category.next().text()}(${category.val()})`)
        return`
          <input
            type='checkbox'
            id='${category.next().text()}'
            class='amp_category'
            name='${category.next().text()}'
            value='${category.val()}'
          />
          <label for='${category.next().text()}'>
            ${category.next().text()}
          </label>
          <br/>
          `
      })
    })

    // simulate the select on the form
    $('#amp_root').on('click', '.amp_category', function () {
      // select out the matching checkbox in the form and check it
      const selectedCategory = category_nodes[[$(this).val()]]

      selectedCategory.prop('checked', $(this).prop('checked'))
      
    })

	});

})( jQuery );
