
BX.ready(function() {
    /*
    1. Спомощью document.querySelectorAll получить все DOM-элементы с классом star
    2. Повесить обработчик события на click
    Пример: BX.bind(element, "click", clickStar);
     */
    const elements = document.querySelectorAll('.star');
    elements.forEach(element => BX.bind(element, "click", clickStar));
});
function clickStar(event) {
    event.preventDefault();

    /*
    Получить agentID, в template.php добавьте тегу с классом star атрибут dataset
    cо значением ID элемента Агента
    (https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/dataset)
     */

    const starEl = event.target.closest('a.star');
    const parentEl = starEl.closest('div.agent__card');
    const agentID = parentEl.dataset.id;

    if (agentID) { // если ID есть, то делаем ajax-запрос
        BX.ajax // https://dev.1c-bitrix.ru/api_help/js_lib/ajax/bx_ajax_runcomponentaction.php
            .runComponentAction(
                "home:agents.list", // название компонента
                "clickStar", // название метода, который будет вызван из class.php
                {
                    mode: "class", //это означает, что мы хотим вызывать действие из class.php
                    data: {
                        agentID: agentID // параметры, которые передаются на бэк
                    },
                }
            )
            .then( // если на бэке нет ошибок выполниться
                BX.proxy((response) => {
                    let data = response.data;
                    if (data['action'] == 'success') {
                        // Отобразить пользоватиелю, что агент добавлен в избраное (желтая звездочка, есть в верстке)
                        const isActive = starEl.classList.contains('active');
                        if (isActive) {
                            starEl.classList.remove('active');
                        } else {
                            starEl.classList.add('active');
                        }
                    }

                }, this)
            )
            .catch( // если на бэке есть ошибки выполниться
                BX.proxy((response) => {
                    console.log(response.errors);
                }, this)
            );
    }

}
