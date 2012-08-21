No diretório "geo" estão todos os dados dos países, estados/departamentos/divisões e cidades no formato JSON.

geo/countries => Lista dos países.

geo/states => Lista dos estados/departamentos/divisões por país.
(Cada arquivo corresponde a um país.)

geo/cities => Lista das cidades dividido por estados/departamentos/divisões.
(Cada diretório corresponde a um país e cada arquivo a um estado/departamento/divisão.)

RELACIONAMENTO:
Os arquivos no diretório "states" tem o nome de seu respectivo país no código ISO.
No diretório "cities" cada sub-diretório tem o nome de seu respectivo país no código ISO, os arquivos nele contidos são nomeados
com um valor chave correspondente a um estado/departamento/divisão.

Ex.: (iso)BR->(dir: states/BR.json)21->(dir: cities/BR/21.json)Rio de Janeiro
