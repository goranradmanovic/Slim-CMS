Zepto(function($){

	"use strict"

	//Dokument root za URL
	var $this = $(this),
		rootURL = 'http://192.168.1.4/Vijezbe/Slim-CMS/public/';

	//Ovo ce se upaliti za svaki AJAX request prema st.
	$(document).on('ajaxBeforeSend', function(e, xhr, options) {
		console.log(e, xhr, options);
	});

	// Call delete album function when button is clicked
	$('#btnDeleteAlbum').live('click', function(event) {
		//Definiranje var tj. dohvatanje ID od albuma
		var $this = $(this),
			albumId = $this.data('identity');
		
		deleteAlbum(albumId); //Brisanje albuma sa odredjenim ID-em
		return false; //Onemogucavanje defaultnog ponasanja linka
	});

	//Call deleteProfileImg function when button is clicked
	$('#btnDelete').live('click', function(event) {
		deleteProfileImg(); //Brisanje albuma sa odredjenim ID-em
		return false; //Onemogucavanje defaultnog ponasanja linka
	});

	//Call deleteSingleAlbumImg
	$('#btnDeleteSinglePhoto').live('click', function(event) {
		//Definiranje var tj. dohvatanje id od slike
		var $this = $(this),
			photoId = $this.data('identity');

		deleteSingleAlbumImg(photoId); //Brisanje pojedinacke korisnikove slike iz odredjenog albuma
		return false; //Onemogucavanje defaultnog ponasanja linka
	});

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

	// Render list of all cars
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

					//Refresh st. sa zadrskom od 3sec
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
	
});