<h2>Replay</h2>
<ul class="action">
	<li>
		<a href=""><img class="flag" src="images/ico/save.png" alt="download">Download ({size})</a>
	</li>
</ul>
<div class="replay-info">
	<div class="players">
		{loop:team_1}
		<div class="team1">
			<img class="race" src="./images/ico/{race}_fond.png" /> 
			 
			<p>
				<span class="player" style="color: #{color};">{name}</span>
				<br />
				<span><strong>apm</strong> {apm}</span>
			</p>
		</div>
		{endloop:team_1}
		<div class="versus">
			<span>vs</span>
		</div>
		{loop:team_2}
		<div class="team2">
			<p>
				<span class="player" style="color: #{color};">{name}</span>
				<br />
				<span><strong>apm</strong> {apm}</span>
			</p>
			
			<img class="race" src="./images/ico/{race}_fond.png" /> 
		</div>
		{endloop:team_2}
	</div>
	<div class="spacer"></div>
	<hr />
	<div class="game-info">
		<h3>Game information</h3>
		<ul class="info">
			<li>
				<span class="stat">map</span>
				<span class="data">{map}</span>
			</li>
			<li>
				<span class="stat">dur&eacute;e</span>
				<span class="data">{length}</span>
			</li>
			<li>
				<span class="stat">date</span>
				<span class="data">{date}</span>
			</li>
		</ul>
		<ul class="info">
			<li>
				<span class="stat">obs</span>
				<span class="data obs" title="{obs}">{obs}</span>
			</li>
			<li>
				<span class="stat">serveur</span>
				<span class="data">{realm}</span>
			</li>
			<li>
				<span class="stat">version</span>
				<span class="data">{version}</span>
			</li>
		</ul>
	</div>
	<div class="spacer"></div>
	<hr />
	<div class="apm-chart">
		<h3>APM Chart</h3>
		<br />
		<img class="chart" src="{chart}" />
	</div>
	<div class="spacer"></div>
</div>