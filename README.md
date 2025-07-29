<h1>Alpine.js + Tailwind CSS Tags Select Component</h1>

<p>
A fully-customizable, accessible, and responsive tags-select input field for forms,<br>
built using <strong>Tailwind CSS v3</strong> and <strong>Alpine.js v3</strong>.<br>
Easily integrates with <strong>Laravel Livewire</strong> or any Alpine.js-enabled project.
</p>

<h2>Features</h2>
<ul>
  <li><b>Async tag search</b> with min-character threshold</li>
  <li><b>Multiple tag selection</b></li>
  <li><b>Keyboard and mouse accessible</b></li>
  <li><b>Clear/tag removal and dropdown toggle</b></li>
  <li><b>Fully styled via Tailwind CSS v3</b></li>
  <li><b>Simple integration with Laravel Livewire or any Alpine.js app</b></li>
</ul>

<h2>Demo</h2>
<img width="1235" height="506" alt="image" src="https://github.com/user-attachments/assets/65805579-6e54-4969-8bb6-f283f7216721" />

<h2>Installation</h2>

<h3>1. Add Dependencies</h3>
<p>Add these CDN links inside your HTML <code>&lt;head&gt;</code>:</p>
<pre><code>&lt;!-- Tailwind CSS 3 CDN --&gt;
&lt;script src="https://cdn.tailwindcss.com"&gt;&lt;/script&gt;
&lt;!-- Alpine.js 3 CDN --&gt;
&lt;script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"&gt;&lt;/script&gt;
</code></pre>
<p>
<em>Optional: For production, you may prefer to install via NPM for better control.</em>
</p>

<h3>2.Keep this field in app as component</h3>
<p>
  To Use component in any form just put "<" select2-livewire-alpinejs :options=[] "/>" --> dont't fogoet to remove extra double quotes.
</p>

<h3>3. Backend Endpoint</h3>
<p>
The code expects an endpoint that returns matching tag options as an array of <code>{ value: string, label: string }</code>.<br>
In Laravel, set up a route for this search, e.g.:
</p>
<pre><code>// Laravel Example Route (web.php)
Route::get('/admin/common/search/tags/{term}', [TagController::class, 'search']);
</code></pre>
<p>
Controller should return JSON data like:
</p>
<pre><code>[
  { "value": 1, "label": "alpinejs" },
  { "value": 2, "label": "tailwind" }
]
</code></pre>

<h3>4. (Optional) Integrate with Livewire</h3>
<ul>
  <li>Wire the <code>tags</code> array to your Livewire component using <code>@entangle('tags')</code> or by binding it in your view.</li>
  <li>On form submit, <code>tags</code> will contain the list of selected tag IDs/values.</li>
</ul>

<p>Example in Blade with Livewire:</p>
<pre><code>&lt;input type="hidden" name="tags" x-model="tags" /&gt;
&lt;!-- Or use @entangle if two-way binding needed --&gt;
</code></pre>

<h2>Usage</h2>
<ul>
  <li>Start typing in the input to search tags.</li>
  <li>Select tags from the dropdown, remove selected tags using the 'X', or clear all.</li>
  <li>The selected list is available as the <code>tags</code> array in Alpine.js scope.</li>
</ul>

<h2>Customization</h2>
<ul>
  <li><b>Styling:</b> Modify Tailwind classes in the component for different color schemes.</li>
  <li><b>Search threshold:</b> Change <code>minSearchLength</code> property in the x-data object.</li>
  <li><b>Loading/empty state:</b> Tweak displayed messages as needed.</li>
</ul>

<h2>Example</h2>
<p>
  <em>The full example code is available in <code>tags-select.html</code>.</em>
</p>

<h2>Contributing</h2>
<ol>
  <li>Fork the repository.</li>
  <li>Create your feature branch (<code>git checkout -b feature/my-feature</code>).</li>
  <li>Commit your changes (<code>git commit -am 'Add new feature'</code>).</li>
  <li>Push to the branch (<code>git push origin feature/my-feature</code>).</li>
  <li>Create a new Pull Request.</li>
</ol>

<h2>License</h2>
<p>
  <a href="./LICENSE">MIT</a> — Use, modify, and distribute freely.
</p>

<h2>Support</h2>
<ul>
  <li>For questions, open an issue on GitHub.</li>
  <li>Pull Requests welcome.</li>
</ul>

<p>
  <strong>Make sure to</strong>:
  <ul>
    <li>Add a screenshot/demo gif.</li>
    <li>Link your endpoint requirements.</li>
    <li>Clarify Alpine.js/Livewire interop as needed.</li>
  </ul>
</p>
