# Configuration file for the Sphinx documentation builder.
#
# For the full list of built-in configuration values, see the documentation:
# https://www.sphinx-doc.org/en/master/usage/configuration.html

# -- Project information -----------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#project-information

project = 'monitor-domotique'
copyright = '2023, Gravier'
author = 'Gravier'
release = '0.1'

# -- General configuration ---------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#general-configuration

extensions = [

    'sphinx_rtd_theme',
]


html_theme = "sphinx_rtd_theme"
html_theme_path = ["_themes", ]
# The name for this set of Sphinx documents.  If None, it defaults to
# "<project> v<release> documentation".
html_title = "Monitor"

# A shorter title for the navigation bar.  Default is the same as html_title.
html_short_title = "Monitor"

# The name of an image file (relative to this directory) to place at the top
# of the sidebar.
html_logo = "images/logo.png"
