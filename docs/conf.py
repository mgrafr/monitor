# -*- coding: utf-8 -*-
#
import sphinx_rtd_theme
import sys
import os
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
       'sphinx.ext.autosectionlabel',
       'sphinx.ext.intersphinx'
      ]
# language = os.getenv("READTHEDOCS_LANGUAGE", "fr")
language = 'fr'
html_theme = "sphinx_rtd_theme"
html_theme_path = ["_themes", ]
html_static_path = ["_static"]
# The name for this set of Sphinx documents.  If None, it defaults to
# "<project> v<release> documentation".
html_title = "Monitor"

# A shorter title for the navigation bar.  Default is the same as html_title.
html_short_title = "Monitor"
# The name of the Pygments (syntax highlighting) style to use.
pygments_style = 'sphinx'
# The name of an image file (relative to this directory) to place at the top
# of the sidebar.
html_logo = "images/logo.png"
# source_suffix = ['.rst', '.md']
source_suffix = '.rst'

# The master toctree document.
master_doc = 'index'
# This is required for the alabaster theme
# refs: http://alabaster.readthedocs.io/en/latest/installation.html#sidebars
html_sidebars = {
    '**': [
        'about.html',
        
    ]
}
rst_prolog = """
.. role:: red
.. role:: darkblue
.. role:: center
"""
def setup(app):
    app.add_css_file('css/custom.css') 
