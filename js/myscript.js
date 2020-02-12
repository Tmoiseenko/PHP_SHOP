$( document ).ready(function($) {

    $("[name='filter']").click(function(e){
        e.preventDefault();
        var category = $('.filter__list-item.active').attr('href');
        var sale = 'sale=' + $('#sale').prop("checked");
        var optNew = 'new=' + $('#new').prop("checked");
        var minPrice = 'min-price=' + $('#min-price').val();
        var maxPrice = 'max-price=' + $('#max-price').val();
        var orderBy = $("[name='order_by'] option:selected").data('value');
        var order_direction = $("[name='order_by'] option:selected").data('direction');
        var url = category + '&' + sale + '&' + optNew + '&' + minPrice + '&' + maxPrice;
        if (order_direction && orderBy){
            url += '&order_by=' +  orderBy + '&order=' + order_direction;
        }
        history.pushState({}, '', url);
        location.reload();
    });

    $("[name='order_by']").change(function (e) {
        e.preventDefault();
        var oldUrl = window.location.href;
        var cleanUrl = oldUrl.split('/')[3];
        if(cleanUrl.search(/[?]order_by=[a-z]*&order=[A-Z]*/) == 0){
            console.log(1);
            var orderBy = '?order_by=' + $('option:selected').data('value');
            var order = '&order=' + $('option:selected').data('direction');
            var cleanUrlNew = cleanUrl.replace(/[?]order_by=[a-z]*&order=[A-Z]*/, '');
            var newUrl = cleanUrlNew + orderBy + order;
            history.pushState({}, '', newUrl);
            location.reload();
        }else if (cleanUrl){
            console.log(2);
            var orderBy = '&order_by=' + $('option:selected').data('value');
            var order = '&order=' + $('option:selected').data('direction');
            var cleanUrlNew = cleanUrl.replace(/&order_by=[a-z]*&order=[A-Z]*/, '');
            var newUrl = cleanUrlNew + orderBy + order;
            history.pushState({}, '', newUrl);
            location.reload();
        }else {
            console.log(3);
            var orderBy = '?order_by=' + $('option:selected').data('value');
            var order = '&order=' + $('option:selected').data('direction');
            var newUrl = cleanUrl + orderBy + order;
            history.pushState({}, '', newUrl);
            location.reload();
        }
    });

    $(".paginator__item").on("click", function (e) {
        e.preventDefault();
        var page = $(this).attr('href');
        var oldUrl = window.location.href;
        var cleanUrl = oldUrl.split('/')[3];

         if(cleanUrl.search(/[?]page=[1-9]*/) == 0){
            console.log(1);
            var cleanUrlNew = cleanUrl.replace(/[?]page=[1-9]*/, '');
            var newUrl = cleanUrlNew + "?" + page;
            history.pushState({}, '', newUrl);
            location.reload();
        }else if (cleanUrl){
            console.log(2);
            var cleanUrlNew = cleanUrl.replace(/&page=[1-9]*/, '');
            var newUrl = cleanUrlNew + "&" + page;
            history.pushState({}, '', newUrl);
            location.reload();
        }else {
            console.log(3);
            var newUrl = cleanUrl + "?" + page;
            history.pushState({}, '', newUrl);
            location.reload();
        }
    })

});
