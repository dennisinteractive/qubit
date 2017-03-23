<?php

namespace Drupal\qubit_lite\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Cache\CacheableResponse as Response;
use Drupal\Core\Url;
use Drupal\Core\Routing\AdminContext;

/**
 * A service for handling all generic site functionality.
 */
class QubitTrackingController extends ControllerBase {

  /**
   * The settings config object for qubit.
   *
   * @var array
   */
  protected $config;

  /**
   * The admin context for the route matcher.
   *
   * @var \Drupal\Core\Routing\AdminContext
   */
  protected $routerAdmin;

  /**
   * Constructs the site core controller.
   */
  public function __construct() {
    $this->config = $this->config('qubit_lite.settings');
  }

  /**
   * Setter injection for router admin context.
   *
   * @param \Drupal\Core\Routing\AdminContext $admin_context
   *   The route matcher context for admin routes.
   */
  public function setRouterContext(AdminContext $admin_context) {
    $this->routerAdmin = $admin_context;
  }

  /**
   * A router callback to generate the tracking page.
   *
   * @return Response
   *   A Symfony response object representing the tracking page.
   */
  public function build() {
    // Generate the page content.
    $script = "<!-- QUBIT SCRIPT: START --><script src='{$this->getScriptUrl()}' async defer></script>";
    if (!empty($this->getScriptUrl())) {
      $content = "<html><head>$script</head><body><h1>Qubit tracking...</h1></body></html>";
    }
    else {
      $content = "<html><head>$script</head><body><h1>Qubit tracking...</h1></body></html>";
    }

    // Add required non-indexing headers.
    $headers = [
      'Content-Type' => 'text/html',
      'X-Robots-Tag' => 'noindex, nofollow, noarchive',
    ];

    return new Response($content, Response::HTTP_OK, $headers);
  }

  /**
   * Helper to get the script url for qubit.
   *
   * @return string
   *   The url of the qubit script tag.
   */
  public function getScriptUrl() {
    $script = "//d3c3cq33003psk.cloudfront.net/opentag-{$this->config->get('customer_id')}-{$this->config->get('site_id')}.js";
    return $this->config->get('customer_id') && $this->config->get('site_id') ? $script : '';
  }

  /**
   * Helper to get the iframe markup.
   *
   * @return string
   *   The rendered markup for the iframe.
   */
  public function getIframeUrl() {
    return Url::fromRoute('qubit_lite.cross_domain_tracking')->getInternalPath();
    return "<!-- Qubit --><iframe src='/{$iframe}' width='1' height='1' style='position:absolute; bottom:0px; left:0px; visibility:hidden'></iframe>";
  }

  /**
   * Checks if Qubit is allowed on the current page.
   */
  public function onCurrentPage() {
    return !$this->routerAdmin->isAdminRoute();
  }

}
