<<<<<<< HEAD
# vanessamassa
Nesse repositório estará apenas os itens do tema do site da Dra. Vanessa Massa.
=======
# Tema WordPress — Site Institucional de Estética

Starter theme clássico para um site institucional com:

- Home institucional
- Header flutuante/sticky
- Hero com imagem em camadas
- Sobre
- Procedimentos
- Prévia do blog
- CTA de agendamento
- Footer com posts recentes e contato
- Blog em `/blog`
- Single post
- Customizer para URL da agenda, WhatsApp, endereço e Instagram
- Paleta CSS centralizada

## Paleta

```css
--color-primary: #fff0f9;
--color-secondary: #000000;
--color-tertiary: #ffffff;
```

## Instalação

1. Compacte ou copie a pasta `michelle-estetica-theme` para:
   `wp-content/themes/`
2. No WordPress, vá em **Aparência → Temas**.
3. Ative o tema.
4. Em **Aparência → Menus**, crie o menu principal e o menu do rodapé.
5. Em **Aparência → Personalizar → Informações do site**, configure:
   - URL da agenda
   - WhatsApp
   - Endereço
   - Instagram
6. Crie uma página chamada `Blog`.
7. Em **Configurações → Leitura**, defina:
   - Página inicial: uma página estática
   - Página de posts: `Blog`

## Observação importante

O arquivo `front-page.php` é o responsável pela Home quando o site usa uma página inicial estática.

O `home.php` é usado como template do índice de posts (a página definida como página de posts).

## Próximos passos recomendados

Para uma versão final, eu adicionaria:

- Custom Post Type `procedimentos`
- Campos estruturados para cada procedimento
- ACF ou blocos Gutenberg para conteúdo editável
- Página individual de procedimento
- SEO
- Schema.org
- formulário/WhatsApp
- integração com a agenda externa
- otimização de imagens
- lazy loading e performance
- acessibilidade
- favicon e Open Graph
- breadcrumbs e paginação do blog
>>>>>>> fbdc590 (Adicionado primeiros arquivos como base para o site da Dra Vanessa Massa)
