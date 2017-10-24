$(document).ready(function(){
    $('.menu-mobile-trigger').sidr();
    $('select').niceSelect();
    $("#modal").iziModal({
        title: 'Colonial Real State | Contact',
        headerColor: '#940404',
        top: 20,
        bottom: 20,
    });
    $("#modal-syh").iziModal({
        title: 'Colonial Real State | Sell your home',
        headerColor: '#940404',
        top: 20,
        bottom: 20,
    });
    $("#modal-cv").iziModal({
        width: '40em',
        title: 'Colonial Real State',
        headerColor: '#046494',
        top: 20,
        bottom: 20,
        transitionIn: 'bounceInUp',
        transitionOut: 'bounceOutDown',
	});
	$(document).foundation();
	var mainslider = new Swiper('#main-slider', {
		autoplay: 2500,
		loop: true,
	});
	var gallerytop = new Swiper('.gallerytop', {
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		spaceBetween: 10,
		pagination: '.swiper-pagination',
		paginationClickable: true,
		autoplay: 2500,
	});
	var gallerythumbs = new Swiper('.gallery-thumbs', {
		spaceBetween: 10,
		centeredSlides: true,
		slidesPerView: 6,
		touchRatio: 0.2
	});

	gallerytop.params.control = gallerythumbs;
	gallerythumbs.params.control = gallerytop;

    if ($('input#tour-virtual').val() == 'true') {
        $('.tour-virtual-slideshow img').slideshowify();
        musicSlideshow();
        // requestFullScreen(document.body);
        setTimeout(function(){
            $('.loading-overlay').fadeOut();
        }, 1000);
    }
    if ($('input#mapa-sma').val() == 'true') {
        initMapSma();
    }

});

function musicSlideshow() {
    var song = Math.floor((Math.random() * 3)) + 1;
    var audio = $('#song-' + song)[0];
    audio.volume = 0.2;
    audio.play();
}

_mailDestino = "carlos@iw.digital";

function modalCorreo(name, mail) {
    $('#modal .small-12 h1 b').html(name);
    $('#modal .small-12 input[name=persona]').val(name);
    $('#modal .small-12 input[name=destino]').val(mail);
    $('#modal').iziModal('open');
}

function modalSyh() {
    $('#modal-syh').iziModal('open');
}

function agent(name, post_id) {
    var modalcv = $('#modal-cv')
    modalcv.iziModal('open');
    modalcv.iziModal('setTitle', 'Colonial Real State | ' + name);
    modalcv.iziModal('startLoading');
    $('#cv-content').html('');
	$.get(base_url + '/api/?operation=cv&a=' + post_id, function(r){
		$('#cv-content').html(r);
        modalcv.iziModal('stopLoading');
	});
}

function sendContact() {
    let f = $('#form-contacto');
    if (validate(f)) {
        let data = getFormData(f);
        console.log(data);
        var msg = "Mensaje de contacto \n\n";
        msg += "\nNombre: " + data.nombre +
            "\nTeléfono: " + data.telefono +
            "\nCorreo Electrónico: " + data.mail +
            "\nMensaje: " + data.mensaje +
            "\nInteresados en: " + data.persona;

        sendMail('no-reply@colonial-realestate.com', $('input[name=destino]').val(), 'Contacto Colonial', msg, function(){
            f.find('input[name]').val("");
            $('#modal').iziModal('close');
            swal('Thank You', 'Our agent will be in touch with you as soon as posible', 'success');
        });
    }
}

function sendInfoPropiedad() {
    let f = $('#info-propiedad');
    if (validate(f)) {
        let data = getFormData(f);
        console.log(data);
        var msg = "Mensaje Info Propiedad \n\n";
        msg += "\nNombre: " + data.name +
            "\nTeléfono: " + data.phone +
            "\nCorreo Electrónico: " + data.mail +
            "\nMensaje: " + data.message +
            "\nInteresados en: " + window.location.href ;


        sendMail('no-reply@colonial-realestate.com', _mailDestino, 'Mensaje Info Propiedad', msg, function(){
            $.get("http://colonial.hostiw.net/api?operation=rp&key=" + data.pk + "&nombre=" + data.name + "&correo=" + data.mail + "&telefono=" + data.phone, function(){
                f.find('[name]').val("");
                swal('Thank You', 'Our agent will be in touch with you as soon as posible', 'success');
            })
        });
    }
}

function sendSYH() {
    let f = $('#form-syh');
    if (validate(f)) {
        let data = getFormData(f);
        console.log(data);
        var msg = "Mensaje de Sell Your Home \n\n";
        msg += "\nNombre: " + data.nombre +
            "\nTeléfono: " + data.telefono +
            "\nCorreo Electrónico: " + data.mail +
            "\nMensaje: " + data.mensaje;

        sendMail('no-reply@colonial-realestate.com', _mailDestino, 'Mensaje de Sell Your Home', msg, function(){
            f.find('input[name]').val("");
            $('#modal-syh').iziModal('close');
            swal('Thank You', 'Our agent will be in touch with you as soon as posible', 'success');
        });
    }
}

function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

function validate($form) {
	if (!$form[0].checkValidity()) {
		$form.find('input[type="submit"]').click();
		return false;
	}
	return true;
}


function sendMail(from, to, subject, msg, callback) {
    var m = new mandrill.Mandrill('lFwDXkU9JM-pHtBjKKUV9g');
    var params = {
        "message": {
            "from_email": from,
            "to":[{"email": to},
                  // {"email": "carlos@iw.digital", "type": "bcc"},
                  // {"email": "ricardo@iw.digital", "type": "bcc"},
                ],
            "subject": subject,
            "text": msg
        }
      };
      m.messages.send(params, function(r) {
          console.log(r);
          callback();
        }, function(e) {
          console.log(e);
        });   
}

$('[href=#sellhome]').on('click', function(){
	// alert('Sell your home with us');
    modalSyh();
})

function virtualTour(post_id) {
    window.open(base_url + '/tour?prop=' + post_id + '','winname','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=' + (window.innerWidth - 200) + ',height=' + (window.innerHeight - 200) + '');
}

function requestFullScreen(element) {
    // Supports most browsers and their versions.
    var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;

    if (requestMethod) { // Native full screen.
        requestMethod.call(element);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}

$('#sidr a').on('click', function(){
    $.sidr('close', 'sidr');
})

$('.gallery-cont [data-img]').click(function(){
    let url = $(this).data('img');
    let img = $('<img>').attr('src', url).css('margin', '2cm auto').css('display', 'block');
    let close = $('<i>').addClass('fa fa-close fa-2x float-right').attr('onclick', 'closeViewer()');
    $('.gallery-cont .img.viewer').html('').append(close).append(img).fadeIn();
})

function closeViewer() {
    $('.img.viewer').fadeOut();
}

function initMapSma() {
    var map = new google.maps.Map(document.getElementById('map-sma'), {
        zoom: 14,
        center: new google.maps.LatLng(20.914449, -100.745235),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0] + '<br><a href="' + locations[i][4] + '">See all properties</a>');
                infowindow.open(map, marker);

            }
        })(marker, i));
    }
}


