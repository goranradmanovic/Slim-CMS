<menu>
	<div class="photos-nav">
		<div class="">
			<ul>
				<li><a href="{{ urlFor('albums.create_album') }}">+ Create Album</a></li>
				<li><a href="{{ urlFor('upload.photos') }}">Add Photos</a></li>
			</ul>
		</div>
		<div class="">
			<ul>
				<li><a href="{{ urlFor('photos.all_photos') }}">Your Photos</a></li>
				<li><a href="{{ urlFor('albums.all_albums') }}">Albums</a></li>
			</ul>
		</div>
	</div>
</menu>