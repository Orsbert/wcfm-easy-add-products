(function( $ ) {
	'use strict';


	// This enables you to define handlers, for when the DOM is ready:
  $(function () {

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
