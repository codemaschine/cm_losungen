<?php

namespace CODEMASCHINE\CmLosungen\Controller;

use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class ActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

  protected ?ModuleTemplate $moduleTemplate = null;

  private ?ModuleTemplateFactory $moduleTemplateFactory = null;

  public function injectModuleTemplateFactory(ModuleTemplateFactory $moduleTemplateFactory) {
    $this->moduleTemplateFactory = $moduleTemplateFactory;
  }

  protected ?PageRenderer $pageRenderer = null;

  public function injectPageRenderer(PageRenderer $pageRenderer)
  {
    $this->pageRenderer = $pageRenderer;
  }

  // protected ?IconFactory $iconFactory = null;

  // public function injectIconFactory(IconFactory $iconFactory)
  // {
  //   $this->iconFactory = $iconFactory;
  // }

  public function __construct(
    private readonly PersistenceManagerInterface $persistenceManager
  ) {
  }

  public function isXhr() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  public function isAjax() {
    return $this->isXhr();
  }

  public function persistAll() {
    $this->persistenceManager->persistAll();
  }

  protected function initializeView(\TYPO3\CMS\Fluid\View\TemplateView|\TYPO3\CMS\Extbase\Mvc\View\JsonView $view) {
    if (ApplicationType::fromRequest($this->request)->isFrontend()) {
      return;
    }

    $view->setTemplateRootPaths([
      'EXT:cm_losungen/Resources/Private/Backend/Templates/',
    ]);
    $view->setPartialRootPaths([
      'EXT:cm_losungen/Resources/Private/Backend/Partials/',
    ]);
    $view->setLayoutRootPaths([
      'EXT:cm_losungen/Resources/Private/Backend/Layouts/',
    ]);
  }

  protected function initializeAction() {
    if (ApplicationType::fromRequest($this->request)->isFrontend()) {
      return;
    }

    $this->pageRenderer->addCssFile('EXT:cm_losungen/Resources/Public/Stylesheets/be_styles.css');
    // $this->pageRenderer->loadJavaScriptModule('@codemaschine/ghcourse/Scripts.js');

    $this->moduleTemplate = $this->moduleTemplateFactory->create($this->request);

    // $buttonBar = $this->moduleTemplate->getDocHeaderComponent()->getButtonBar();

    // $params = $this->request->getQueryParams();
    // unset($params['token']);
    // /**
    //  * @var \TYPO3\CMS\Backend\Routing\RouteResult
    //  */
    // $routing = $this->request->getAttribute('routing');
    // $shortcutButton = $buttonBar->makeShortcutButton()
    //   ->setRouteIdentifier($routing->getRouteName())
    //   ->setDisplayName('Shortcut')
    //   ->setArguments($params);
    // $buttonBar->addButton($shortcutButton);


    $menuRegistry = $this->moduleTemplate->getDocHeaderComponent()->getMenuRegistry();

    $menu = $menuRegistry->makeMenu();
    $menu->setIdentifier('ModuleMenu');

    $ModuleMenuItem = $menu->makeMenuItem();
    $ModuleMenuItem->setTitle('Losungen')->setHref($this->uriBuilder->reset()->uriFor('list', null, 'Losung'));
    $ModuleMenuItem->setActive($this->request->getControllerName() == 'Losung');
    $menu->addMenuItem($ModuleMenuItem);

    $ParticipantMenuItem = $menu->makeMenuItem();
    $ParticipantMenuItem->setTitle('XML-Losungen hochladen')->setHref($this->uriBuilder->reset()->uriFor('new', null, 'ImportFile'));
    $ParticipantMenuItem->setActive($this->request->getControllerName() == 'ImportFile');
    $menu->addMenuItem($ParticipantMenuItem);

    $menuRegistry->addMenu($menu);
  }

  // protected function addBackButton(?string $actionName = null, ?array $controllerArguments = null, ?string $controllerName = null) {
  //   if ($actionName === null && $controllerArguments === null && $controllerName === null) {
  //     $actionName = 'list';
  //   }

  //   $href = $this->uriBuilder->reset()->uriFor($actionName, $controllerArguments, $controllerName);

  //   $buttonBar = $this->moduleTemplate->getDocHeaderComponent()->getButtonBar();
  //   $linkButton = $buttonBar->makeLinkButton()
  //     ->setHref($href)
  //     ->setTitle(LocalizationUtility::translate('LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.goBack'))
  //     ->setIcon($this->iconFactory->getIcon('actions-view-go-back', Icon::SIZE_SMALL));
  //   $buttonBar->addButton($linkButton);
  // }

  // protected function addNewButton(?string $actionName = null, ?array $controllerArguments = null, ?string $controllerName = null) {
  //   if ($actionName === null && $controllerArguments === null && $controllerName === null) {
  //     $actionName = 'new';
  //   }

  //   $href = $this->uriBuilder->reset()->uriFor($actionName, $controllerArguments, $controllerName);

  //   $buttonBar = $this->moduleTemplate->getDocHeaderComponent()->getButtonBar();
  //   $linkButton = $buttonBar->makeLinkButton()
  //     ->setHref($href)
  //     ->setTitle(LocalizationUtility::translate('LLL:EXT:backend/Resources/Private/Language/locallang_layout.xlf:newRecordGeneral'))
  //     ->setIcon($this->iconFactory->getIcon('actions-add', Icon::SIZE_SMALL));
  //   $buttonBar->addButton($linkButton);
  // }
}
