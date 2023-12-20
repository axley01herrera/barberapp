<textarea id="kt_docs_tinymce_basic" name="kt_docs_tinymce_basic" class="tox-target">
    <h1>Quick and Simple TinyMCE 5 Integration</h1>
    <p>Here goes the&nbsp;<a href="#">Minitial content of the editor</a>. Lorem Ipsum is simply dummy text of the&nbsp;<em>printing and typesetting</em>&nbsp;industry.</p>
    <blockquote>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</blockquote>
    <h3 style="text-align: right;">Flexible &amp; Powerful</h3>
    <p style="text-align: right;"><strong>Lorem Ipsum has been the industry's</strong>&nbsp;standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
    <ul>
        <li>List item 1</li>
        <li>List item 2</li>
        <li>List item 3</li>
        <li>List item 4</li>
    </ul>
</textarea>

<script>
    var options = {
        selector: "#kt_docs_tinymce_basic",
        height: "480"
    };

    if (KTThemeMode.getMode() === "dark") {
        options["skin"] = "oxide-dark";
        options["content_css"] = "dark";
    }

    tinymce.init(options);
</script>