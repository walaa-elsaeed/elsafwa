//Allow Write Numbers Only
function allowNumbers(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    {
        return false;
    }
    return true;
}



//get citis for city dropdown
function getCities() {
    $.ajax({
        url: $('#u').attr('value'),
        type: 'post',
        data: {
            government: $('#government').val(),
            _token : $('#t').attr('value')

        },
        success: function (data) {

            var d = JSON.parse(data);
            $('#zone').attr("value",0);
            $('#city').children('li').remove();
            $('#city').append("<li data-value='0' value='0' data-selected=\"true\">Zone</li>");
            for (var i = 0; i < d.length; i++) {
                $('#city').append("<li data-value='0' value='"+d[i].id+"'>"+d[i].name+"</li>");
            }
        },
        failure/*error*/: function(e){

        },
        complete: function () {
            // $('#loading-image-stat').hide();
        }
    });
}

//get cybers for zone blade
function getCybers($center){
    $.ajax({
        url: $('#uC').attr('value'),
        type: 'post',
        data: {
            government : $('#government').val(),
            city  : $('#zone').val(),
            lat : parseFloat($('#lat').val()),
            lng : parseFloat($('#lng').val()),
            page : $('#page').val(),
            dis : $('#rad').val(),
            _token : $('#t').attr('value')

        },
        success: function (data) {

            var d = JSON.parse(data);
            $('#cybers').children().remove();
            var cybersCount;
            for (var i = 0; i < d.length; i++) {
                $('#cybers').append(d[i].card);
                drawCyberOnMap($center,d[i].cybers);
                cybersCount = d[i].totalCybers
            }
            var current = parseInt($('#page').val());
            var allCybers = parseInt(d[0].allCybers);
            $('#pagi').children().remove();
            if(allCybers > 0){
                if(current>=4){
                    $('#pagi').append('<li><button class="btn btn-default" onclick="prevPage();"><<</buttonclass></li>');
                    for (var i=1; i<=4;i++){
                        var newValue = current+i;
                        if ((newValue * 4) <= allCybers+4)
                            $('#pagi').append('<li><button class="btn btn-default" onclick="updatePage(this.value);" value="'+(newValue)+'">'+(newValue)+'</buttonclass></li>');
                    }
                    if(((current*4)+4) <= allCybers-4)
                        $('#pagi').append('<li><button class="btn btn-default" onclick="nextPage();">>></buttonclass></li>');
                    /*console.log('all cybers is '+allCybers);
                    console.log('el current b3d 4 lafat',(current+4));*/
                }
                else{
                    for (var i=0; i<4;i++){
                        if((i*4) <= allCybers)
                            $('#pagi').append('<li><button class="btn btn-default" onclick="updatePage(this.value);" value="'+(i+1)+'">'+(i+1)+'</buttonclass></li>');
                    }
                }
            }
            //Trigger Map Section Height
            $('.map').height($('.boxses').height()+32);

            google.maps.event.trigger(map, "resize");
        },
        failure: function(e){

        },
        complete: function () {
            $('.map').height($('.boxses').height()+32);
            $("body").getNiceScroll().resize();
        }
    });
}








