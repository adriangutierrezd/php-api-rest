<h1>Inicio</h1>
<p>Esta es una API REST desarrollada con PHP, sin ningún framework o librería externa. Cuenta con las functiones básicas de un CRUD, salvo que para Read, Update y Delete es necesario un token que se puede obtener registrándose.</p>

<h2>Ver POSTs</h2>
<div class="api-doc">
    <p><b>Autenticación</b>: no</p>
    <p><b>URL</b>: <?=base_api_posts?>posts.php</p>
    <hr>
    <p><b>Ejemplo</b>:</p>
<pre>
<code>
<span class="function">getPosts</span>();
<span class="special">async</span> function <span class="function">getPosts</span>(){
    <span class="const">const</span> info = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    }
    <span class="const">const</span> response = <span class="special">await</span> <span class="function">fetch</span>('<?=base_api_posts?>posts.php', info)
    <span class="const">const</span> data = <span class="special">await</span> response.<span class="function">json</span>();
    console.<span class="function">log</span>(data);
}
</code>
</pre>
</div>
<h2>Ver un POST específico</h2>
<div class="api-doc">
    <p><b>Autenticación</b>: no</p>
    <p><b>URL</b>: <?=base_api_posts?>posts.php?id=:id</p>
    <hr>
    <p><b>Ejemplo</b>:</p>
<pre>
<code>
<span class="function">getPost</span>();
<span class="special">async</span> function <span class="function">getPost</span>(){
    <span class="const">const</span> info = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    }
    <span class="const">const</span> response = <span class="special">await</span> <span class="function">fetch</span>('<?=base_api_posts?>posts.php?id=7', info)
    <span class="const">const</span> data = <span class="special">await</span> response.<span class="function">json</span>();
    console.<span class="function">log</span>(data);
}
</code>
</pre>
</div>
<h2>Insertar un POST</h2>
<div class="api-doc">
    <p><b>Autenticación</b>: token</p>
    <p><b>URL</b>: <?=base_api_posts?>create.php</p>
    <hr>
    <p><b>Ejemplo</b>:</p>
<pre>
<code>
<span class="function">createPost</span>();
<span class="special">async</span> function <span class="function">createPost</span>(){
    <span class="const">const</span> params = {
        "title": "Spring Boot",
        "body": "Spring Boot is an open source, microservice-based Java web framework. The Spring Boot framework creates a fully production-ready environment...",
        "author": "VMware",
        "category_id": 2,
        "token": "YOUR-TOKEN"
    }
    <span class="const">const</span> info = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: <span class="special">JSON</span>.<span class="function">stringify</span>(params)
    }
    <span class="const">const</span> response = <span class="special">await</span> <span class="function">fetch</span>('<?=base_api_posts?>create.php', info)
    <span class="const">const</span> data = <span class="special">await</span> response.<span class="function">json</span>();
    console.<span class="function">log</span>(data);
}
</code>
</pre>
</div>
<h2>Editar un POST</h2>
<div class="api-doc">
    <p><b>Autenticación</b>: token</p>
    <p><b>URL</b>: <?=base_api_posts?>update.php</p>
    <hr>
    <p><b>Ejemplo</b>:</p>
<pre>
<code>
<span class="function">updatePost</span>();
<span class="special">async</span> function <span class="function">updatePost</span>(){
    <span class="const">const</span> params = {
        "id": 1,
        "title": "TypeScript",
        "body": "TypeScript...",
        "author": "Microsoft",
        "category_id": 1,
        "token": "YOUR-TOKEN"
    }
    <span class="const">const</span> info = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: <span class="special">JSON</span>.<span class="function">stringify</span>(params)
    }
    <span class="const">const</span> response = <span class="special">await</span> <span class="function">fetch</span>('<?=base_api_posts?>update.php', info)
    <span class="const">const</span> data = <span class="special">await</span> response.<span class="function">json</span>();
    console.<span class="function">log</span>(data);
}
</code>
</pre>
</div>
<h2>Eliminar un POST</h2>
<div class="api-doc">
    <p><b>Autenticación</b>: token</p>
    <p><b>URL</b>: <?=base_api_posts?>delete.php</p>
    <hr>
    <p><b>Ejemplo</b>:</p>
<pre>
<code>
<span class="function">deletePost</span>();
<span class="special">async</span> function <span class="function">deletePost</span>(){
    <span class="const">const</span> params = {
        "id": 9,
        "token": "YOUR-TOKEN"
    }
    <span class="const">const</span> info = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: <span class="special">JSON</span>.<span class="function">stringify</span>(params)
    }
    <span class="const">const</span> response = <span class="special">await</span> <span class="function">fetch</span>('<?=base_api_posts?>delete.php', info)
    <span class="const">const</span> data = <span class="special">await</span> response.<span class="function">json</span>();
    console.<span class="function">log</span>(data);
}
</code>
</pre>
</div>

