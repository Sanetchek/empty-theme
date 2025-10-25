<?php
/**
 * Template Name: Sidebar Demo
 *
 * Демонстрационная страница для показа различных виджетов сайдбара
 *
 * @package emptytheme
 */

get_header();
?>

<div class="container">
    <article class="page-content-wrapper">
        <div class="page-wrapper">
            <header class="entry-header">
                <div class="container">
                    <h1 class="entry-title">Демонстрация виджетов сайдбара</h1>
                    <div class="entry-excerpt">
                        Красивые виджеты сайдбара, отображаемые внизу страницы
                    </div>
                </div>
            </header>

            <div class="entry-content">
                <div class="container">
                    <div class="sidebar-demo-content">
                        <h2>Основной контент страницы</h2>
                        <p>Это демонстрационная страница для показа виджетов сайдбара. Сайдбар отображается внизу страницы в виде красивых карточек с различными виджетами.</p>

                        <h3>Особенности дизайна:</h3>
                        <ul>
                            <li>Сайдбар размещается внизу страницы</li>
                            <li>Виджеты отображаются в виде карточек</li>
                            <li>Адаптивная сетка для разных размеров экрана</li>
                            <li>Красивые hover-эффекты</li>
                            <li>Единый стиль для всех виджетов</li>
                        </ul>

                        <p>Прокрутите вниз, чтобы увидеть виджеты сайдбара.</p>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<style>
.sidebar-demo-content {
    padding: 2rem 0;
    min-height: 60vh;
}

.sidebar-demo-content h2 {
    font-size: 2rem;
    color: var(--color-dark);
    margin-bottom: 1.5rem;
    font-family: var(--font-urbanist);
}

.sidebar-demo-content h3 {
    font-size: 1.5rem;
    color: var(--color-dark);
    margin: 2rem 0 1rem 0;
    font-family: var(--font-urbanist);
}

.sidebar-demo-content p {
    font-size: 1.125rem;
    line-height: 1.7;
    color: var(--color-text);
    margin-bottom: 1.5rem;
}

.sidebar-demo-content ul {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.sidebar-demo-content li {
    font-size: 1.125rem;
    line-height: 1.6;
    color: var(--color-text);
    margin-bottom: 0.5rem;
}
</style>

<?php
get_sidebar();
get_footer();
