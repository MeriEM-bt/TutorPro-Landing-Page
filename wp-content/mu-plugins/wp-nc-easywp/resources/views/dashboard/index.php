<!--
 |
 | In $plugin you'll find an instance of Plugin class.
 | If you'd like can pass variable to this view, for example:
 |
 | return PluginClassName()->view( 'dashboard.index', [ 'var' => 'value' ] );
 |
-->

<div class="wpnceasywp wrap">
  <h1><?php echo $plugin->Name; ?> ver.<?php echo $plugin->Version; ?></h1>
  <h2>
    PHP ver.<?php echo phpversion(); ?>
  </h2>

  <h2>YAML config</h2>

  <details>
    <summary>Click to see the YAML config</summary>
    <p>YAML flags version: <?php echo wpbones_flags()->flags('version') ?></p>
    <p>YAML flags HackGuardian:</p>
    <pre>
      <?php print_r(wpbones_flags()->flags('hackguardian')) ?>
    </pre>
    <p>YAML flags Monarx:</p>
    <pre>
      <?php print_r(wpbones_flags()->flags('monarx')) ?>
    </pre>
  </details>

  <?php if (!empty($plugins)): ?>

    <h2><?php _e("Plugins...", "wp-nc-easywp"); ?></h2>

    <h4><?php _e("Warning", "wp-nc-easywp"); ?></h4>

    <p>
      <?php echo _n(
        "The following plugin will be disabled.",
        "The following plugins will be disabled.",
        count($plugins),
        "wp-nc-easywp"
      ); ?>
    </p>

    <ul>

      <?php foreach ($plugins as $file => $value): ?>
        <li>
          <?php printf(
            __("%s will be disabled because: %s", "wp-nc-easywp"),
            $value["data"]["Name"],
            $value["info"]["description"]
          ); ?>
        </li>
      <?php endforeach; ?>

    </ul>

    <hr />

  <?php endif; ?>

  <h2>Paths</h2>

  <details>
    <summary>Click to see the paths</summary>
    <p>__FILE__: <code><?php echo __FILE__; ?></code></p>
    <p>__DIR__: <code><?php echo __DIR__; ?></code></p>
    <p>ABSPATH: <code><?php echo ABSPATH; ?></code></p>
    <p>WP_CONTENT_DIR: <code><?php echo WP_CONTENT_DIR; ?></code></p>
    <p>WP_CONTENT_URL: <code><?php echo WP_CONTENT_URL; ?></code></p>
    <p>WP_PLUGIN_DIR: <code><?php echo WP_PLUGIN_DIR; ?></code></p>
    <p>WP_PLUGIN_URL: <code><?php echo WP_PLUGIN_URL; ?></code></p>
    <p>WPMU_PLUGIN_DIR: <code><?php echo WPMU_PLUGIN_DIR; ?></code></p>
    <p>WPMU_PLUGIN_URL: <code><?php echo WPMU_PLUGIN_URL; ?></code></p>
    <p>plugin->basePath: <code><?php echo $plugin->basePath; ?></code></p>
    <p>plugin->baseUri: <code><?php echo $plugin->baseUri; ?></code></p>
    <p>plugin->js: <code><?php echo $plugin->js; ?></code></p>
    <p>plugin->css: <code><?php echo $plugin->css; ?></code></p>
  </details>

  <hr />

  <h2>Environment variables</h2>
  <h3>By getenv()</h3>

  <details>
    <summary>Click to see the environment variables</summary>
    <?php
    $envVars = getenv();
    foreach ($envVars as $key => $value) {
      echo "<p>$key: <code>$value</code></p>";
    }
    ?>
  </details>

  <hr />

  <h3>By $_ENV</h3>

  <details>
    <summary>Click to see the environment variables</summary>
    <?php
    $envVars = $_ENV;
    foreach ($envVars as $key => $value) {
      echo "<p>$key: <code>$value</code></p>";
    }
    ?>
  </details>

  <hr />

  <h3>By $_SERVER</h3>

  <details>
    <summary>Click to see the environment variables</summary>
    <?php
    $envVars = $_SERVER;
    $envVars = array_filter($envVars, function ($key) {
      return strpos($key, 'HTTP_') === false;
    }, ARRAY_FILTER_USE_KEY);

    foreach ($envVars as $key => $value) {
      echo "<p>$key: <code>$value</code></p>";
    }
    ?>
  </details>

  <hr />

  <h3>Hack Guardian and Monarx</h3>

  <?php
  $jwt_token = easywpJWT()->token;
  $appId = easywpJWT()->websiteId;
  ?>

  <p>JWT_TOKEN: <code><?php echo $jwt_token; ?></code></p>
  <p>WEBSITE_WEBHOOK_URL: <code><?php echo getenv("WEBSITE_WEBHOOK_URL"); ?></code></p>
  <p>EASYWP_READONLY: <code><?php echo getenv("EASYWP_READONLY"); ?></code></p>
  <p>APP_ID: <code><?php echo $appId; ?></code></p>

  <?php
  $notifictions = useMonarx();
  echo "<h3>Monarx notifications</h3>";
  echo "<pre>";
  print_r($notifictions);
  echo "</pre>";
  ?>

  <?php
  $notifictions = useMonarx(true);
  echo "<h3>Monarx notifications - no cached</h3>";
  echo "<pre>";
  print_r($notifictions);
  echo "</pre>";
  ?>

  <hr />

  <h2>WordPress Readonly</h2>

  <code>in progress...</code>

  <hr />

  <h2>Kubernetes</h2>

  <?php $info = \WPNCEasyWP\Http\Varnish\VarnishCache::info(); ?>

  <p>HOSTNAME: <code><?php echo $info["HOSTNAME"]; ?></code></p>
  <p>Service: <code><?php echo $info["svc"]; ?></code></p>
  <p>IPs: <code><?php echo $info["ips"]; ?></code></p>

  <hr />

  <h2>Cache info</h2>

  <?php $varnish = WPNCEasyWP()->options->get("varnish"); ?>

  <ul>
    <li>Varnish: <code><?php echo $varnish["enabled"] ? "Enabled" : "Disabled"; ?></code></li>
    <li>Schema: <code><?php echo $varnish["schema"]; ?></code></li>
    <li>default_purge_method: <code><?php echo $varnish["default_purge_method"]; ?></code></li>
    <li>Last purge: <code><?php echo $varnish["last_purge"]; ?></code></li>
  </ul>

  <hr />

  <h3>Last Purged URLs</h3>
  <details>
    <summary>Click to see the last purged URLs</summary>
    <pre>
<?php foreach ($varnish["last_purged_urls"] as $url): ?>
<?php echo "{$url}\n"; ?>
<?php endforeach; ?>
    </pre>
  </details>

  <hr />

  <details>
    <summary>Click to see the options</summary>
    <pre>
    <?php echo WPNCEasyWP()->options; ?>
  </pre>
  </details>

</div>