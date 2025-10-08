$('select[name=content_type]').on('change', async function (e) {
    let selected = $(this).find('option:selected').val();

    const token = $('meta[name="token"]').attr('content');
    const url = hostUrl + `/api/select2ajax/investment_outlooks_categories/category_name/category_name`;
    
    $('select[name=title]').select2({
        width: '100%',
        allowClear: true,
        delay: 250,
        placeholder: `Select Ttitle`,
        ajax: {
            url: await url,
            headers: {
                'Authorization': 'Bearer ' + token
            },
            data: function (params) {
                var query = {
                    search: params.term,
                    params: {'content_type': selected}
                }

                return query;
            },
            processResults: function (data, params) {
                return {
                    results: data.results,
                };
            }
        }
    });
}).trigger('change');