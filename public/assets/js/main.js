"use strict"

$(function() {
	//Pozivanje funkcije kad se ucita dokument
	uploadPhotos('#uploadPhotosForm'); //Upload slika u albume
	uploadPhotos('#UserUploadProfileImage'); //Upload korisnikove prfile slike

	//Ovo ce se upaliti za svaki AJAX request prema st.
	$(document).on('ajaxBeforeSend', function(e, xhr, options) {
		console.log(e, xhr, options);
	});

	// Call delete album function when button is clicked
	$('#btnDeleteAlbum').on('click', function(event) {
		//Definiranje var tj. dohvatanje ID od albuma
		var $this = $(this),
			albumId = $this.data('identity');
		
		deleteAlbum(albumId); //Brisanje albuma sa odredjenim ID-em
		return false; //Onemogucavanje defaultnog ponasanja linka
	});

	//Call deleteProfileImg function when button is clicked
	$('#btnDelete').on('click', function(event) {
		deleteProfileImg(); //Brisanje albuma sa odredjenim ID-em
		return false; //Onemogucavanje defaultnog ponasanja linka
	});

	//Call deleteSingleAlbumImg
	$('#btnDeleteSinglePhoto').on('click', function(event) {
		//Definiranje var tj. dohvatanje id od slike
		var $this = $(this),
			photoId = $this.data('identity');

		deleteSingleAlbumImg(photoId); //Brisanje pojedinacke korisnikove slike iz odredjenog albuma
		return false; //Onemogucavanje defaultnog ponasanja linka
	});
});

//Ajax Upload files form upload_photos.php (Arg. je ID od forme)
function uploadPhotos(formID) {

	//Selektujemo upload formu
	$(formID).on('submit', function (e) {

		//Onemogucavamo defaultno ponasanje forme
		e.preventDefault();

		//Korisitmo ajaxSubmit funk. iz jquery.form.js plugina
		$(this).ajaxSubmit({

			//Prije slanja podataka
			beforeSend: function () {
				//Prikazujemo progres bar zato sto je prvobitno sakriven do se ne pocene sa uploadom
				$('#progress').show();
				//Dajemo jos vrijednost 0 tj. da procenti krenu sa 0
				$('#progress-bar').attr('aria-valuenow', '0');
			},

			//Progres ucitavanja fajla
			uploadProgress: function (event, position, total, percentComplete) {
				//Dohvatamo progres bar i dajemo joj novu vriejdnost u zavisnosti koliko je ucitano
				$('#progress-bar').attr('aria-valuenow', percentComplete); //Ispis vrijednosti u aria-valuenow atribut
				$('#progress-bar').css('width', percentComplete + '%'); //Ispis vrijdenosti % u css width
				$('#progress-bar').html(percentComplete + '%'); //Ispis broja % u progres bar
				$('#percent').html(percentComplete + '% Completed.'); //Ispis broja % u procent span
			},

			//Po uspijeno ucitanom fajlu
			success: function (data) {

				//console.log(data);
				//Čisćenje forme od podataka nakon uploada slika
				$(formID).resetForm(true);
			
				//Prikazivanje potvrdne poruke o uspijesno ucitanom fajlu
				//Dohvatanja div sa id 'message' i ispis porke u njemu koja dolazi od servera
				$('#info-message').show().html(data['message']);
				
				//Po zavrsetku i ucitavanju fajlova cistimo formu od ulazinh podataka (alternativni nacin)
				//$('#PhotosUploadForm')[0].reset();

				swal({
					title: "You successfully upload your photos.",
					type: "success",
					showConfirmButton: false,
					timer: 1600,
				});
			},

			//Izvrsavanje funkcije prilikom pojave greske
			error: function (data) {
				$('#info-message').show().html(data['message']);
				//console.log(data);
			}
		});
	});
}


//Dokument root za URL
var $this = $(this),
	rootURL = 'http://192.168.1.4/Vijezbe/Slim-CMS/public/';

//Funkcija za dohvatanje svih korisnikovih albuma
function getAllAlbums()
{
	$.ajax({
		type: "GET",
		contentType: "application/json; charset=utf-8",
		url: rootURL + 'all_albums',
		data: "{}",
		dataType: "json",
		success: function (data) {
			console.log(data);
		},
		error: function (result) {
			console.log("Error");
		}
	});
}

// Render list of all albums
function renderList(data) {
	$.each(data, function(index, album) {
		$('#album').append('<li><a href="#" data-identity="' + album.id + '">' + album.title + '</a></li>');
	});
}

//Funkcija za brisanje albuma
function deleteAlbum(id)
{
	//Sweetaler funk. za prikazivanje poruke i dugmeta za cancel i confirm
	swal({
		title: "Are you sure?",
		text: "You will not be able to recover this album!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "No, cancel please!",
		closeOnConfirm: false,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
		closeOnCancel: false,
		},
		
		function(isConfirm)
		{	
			//Ako je stisnuto na dugme confirm
			if (isConfirm)
			{
				//AJAX zahtijev za brisanje
				$.ajax({
					type: 'GET',
					url: rootURL + 'delete_album/' + id,
					success: function(data) {
						console.log(data);
					},
					error: function(xhr, type, textStatus, errorThrown) {
						console.log(xhr, type, errorThrown, textStatus);
					}
				});
				
				//Odgadjamo izvrsavanje poruke na pola sec. dok se ajax zahtijav izvrsi
				setTimeout(function(){
					swal("Deleted!", "Your album has been deleted.", "success");
				}, 550);

				//Refresh st. sa zadrskom od 1sec
				setTimeout(function () {
					location.reload();
				}, 1000);
			}
			else
			{
				swal("Cancelled", "Your album is safe :)", "error");
			}
		}
	);	
}

//Funkcija za brisanje korisnikove profilne slike
function deleteProfileImg()
{
	//Sweetaler funk. za prikazivanje poruke i dugmeta za cancel i confirm
	swal({
		title: "Are you sure?",
		text: "You will not be able to recover this photo!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "No, cancel please!",
		closeOnConfirm: false,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
		closeOnCancel: false,
		},
		
		function(isConfirm)
		{	
			//Ako je stisnuto na dugme confirm
			if (isConfirm)
			{
				//AJAX zahtijev za brisanje
				$.ajax({
					type: 'GET',
					url: rootURL + 'delete_img',
					success: function(data) {
						console.log(data);	
					},
					error: function(xhr, type, textStatus, errorThrown) {
						console.log(xhr, type, errorThrown, textStatus);
					}
				});
				
				//Odgadjamo izvrsavanje poruke na pola sec. dok se ajax zahtijav izvrsi
				setTimeout(function(){
					swal("Deleted!", "Your photo has been deleted.", "success");
				}, 550);

				//Refresh st. sa zadrskom od 3sec
				setTimeout(function () {
					location.reload();
				}, 1000);
			}
			else
			{
				swal("Cancelled", "Your photo is safe :)", "error");
			}
		}
	);	
}

//Funkcija za brisanje korisnikovih slika iz odredjenog albuma
function deleteSingleAlbumImg(id)
{
	//Sweetaler funk. za prikazivanje poruke i dugmeta za cancel i confirm
	swal({
		title: "Are you sure?",
		text: "You will not be able to recover this photo!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "No, cancel please!",
		closeOnConfirm: false,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
		closeOnCancel: false,
		},
		
		function(isConfirm)
		{	
			//Ako je stisnuto na dugme confirm
			if (isConfirm)
			{
				//AJAX zahtijev za brisanje
				$.ajax({
					type: 'GET',
					url: rootURL + 'delete_photo/' + id,
					success: function(data) {
						console.log(data);
					},
					error: function(xhr, type, textStatus, errorThrown) {
						console.log(xhr, type, errorThrown, textStatus);
					}
				});
				
				//Odgadjamo izvrsavanje poruke na pola sec. dok se ajax zahtijav izvrsi
				setTimeout(function(){
					swal("Deleted!", "Your photo has been deleted.", "success");
				}, 550);

				//Refresh st. sa zadrskom od 3sec
				setTimeout(function () {
					location.reload();
				}, 1000);
			}
			else
			{
				swal("Cancelled", "Your photo is safe :)", "error");
			}
		}
	);	
}