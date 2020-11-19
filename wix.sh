#!/bin/bash
echo "==> Ejecutando"
mkdir -p $1
cd $1
echo $2 | cat > index.php
mkdir css
mkdir user
cd user
> estilo.css
cd ..
mkdir admin
cd admin
> estilo.css
cd ..
mkdir img
mkdir avatars
mkdir buttons
mkdir products
mkdir pets
mkdir js
mkdir validations
cd validations
>login.js
>register.js
cd ..
mkdir effects
cd effects
>panels.js
cd ..
mkdir tpl
cd tpl
>main.tpl
>login.tpl
>register.tpl
>panel.tpl
>profile.tpl
>crud.tpl
cd ..
mkdir php
cd php
>create.php
>read.php
>update.php
>delete.php
>dbconect.php
cd ..
echo "==> Fin"