<?php
/**
 * Template Name: Form Buttons Demo
 *
 * Демонстрационная страница для показа различных стилей кнопок submit
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
                    <h1 class="entry-title">Демонстрация стилей кнопок Submit</h1>
                    <div class="entry-excerpt">
                        Различные варианты стилизации кнопок input[type="submit"] и button[type="submit"]
                    </div>
                </div>
            </header>

            <div class="entry-content">
                <div class="container">
                    <div class="buttons-demo">

                        <!-- Основные стили -->
                        <section class="demo-section">
                            <h2>Основные стили</h2>
                            <div class="demo-grid">
                                <div class="demo-item">
                                    <h3>Стандартная кнопка</h3>
                                    <form>
                                        <input type="submit" value="Отправить">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3>Button элемент</h3>
                                    <form>
                                        <button type="submit">Отправить форму</button>
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3>С иконкой</h3>
                                    <form>
                                        <button type="submit">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path d="M22 2L11 13M22 2L15 22L11 13M22 2L2 9L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Отправить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- Альтернативные стили -->
                        <section class="demo-section">
                            <h2>Альтернативные стили</h2>
                            <div class="demo-grid">
                                <div class="demo-item">
                                    <h3>Outline стиль</h3>
                                    <form>
                                        <input type="submit" value="Outline кнопка" class="outline">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3>Dark стиль</h3>
                                    <form>
                                        <input type="submit" value="Dark кнопка" class="dark">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3>С классом form-submit-button</h3>
                                    <form>
                                        <input type="submit" value="С классом" class="form-submit-button">
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- Размеры -->
                        <section class="demo-section">
                            <h2>Размеры кнопок</h2>
                            <div class="demo-grid">
                                <div class="demo-item">
                                    <h3>Маленькая</h3>
                                    <form>
                                        <input type="submit" value="Small" class="small">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3>Стандартная</h3>
                                    <form>
                                        <input type="submit" value="Normal">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3>Большая</h3>
                                    <form>
                                        <input type="submit" value="Large кнопка" class="large">
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- Состояния -->
                        <section class="demo-section">
                            <h2>Состояния кнопок</h2>
                            <div class="demo-grid">
                                <div class="demo-item">
                                    <h3>Обычная</h3>
                                    <form>
                                        <input type="submit" value="Обычная">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3>Отключенная</h3>
                                    <form>
                                        <input type="submit" value="Отключена" disabled>
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3>Загрузка</h3>
                                    <form>
                                        <button type="submit" class="loading">Загрузка...</button>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- Полная форма -->
                        <section class="demo-section">
                            <h2>Пример полной формы</h2>
                            <form class="demo-form">
                                <div class="form-group">
                                    <label for="name" class="form-label">Имя</label>
                                    <input type="text" id="name" name="name" class="form-input" placeholder="Введите ваше имя">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-input" placeholder="your@email.com">
                                </div>

                                <div class="form-group">
                                    <label for="message" class="form-label">Сообщение</label>
                                    <textarea id="message" name="message" class="form-textarea" placeholder="Ваше сообщение"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Отправить сообщение">
                                </div>
                            </form>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<style>
.buttons-demo {
    padding: 2rem 0;
}

.demo-section {
    margin-bottom: 3rem;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 15px;
}

.demo-section h2 {
    margin-bottom: 2rem;
    color: var(--color-dark);
    font-family: var(--font-urbanist);
    font-size: 1.75rem;
    border-bottom: 2px solid var(--color-yellow);
    padding-bottom: 0.5rem;
}

.demo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.demo-item {
    background: var(--color-white);
    padding: 1.5rem;
    border-radius: 12px;
}

.demo-item h3 {
    margin-bottom: 1rem;
    color: var(--color-dark);
    font-family: var(--font-urbanist);
    font-size: 1.125rem;
}

.demo-form {
    max-width: 500px;
    margin: 0 auto;
}

.demo-form .form-group {
    margin-bottom: 1.5rem;
}

.demo-form .form-group:last-child {
    margin-bottom: 0;
    text-align: center;
}
</style>

<?php
get_footer();
